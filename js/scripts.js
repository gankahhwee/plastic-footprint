w3IncludeHTML();

var steps = $(".step"), bootstrapSlider, trashContainer;

setTimeout(function(){
    $("div.step.hidden").removeClass("hidden");
    
    $('input.check_radio').iCheck({
    	checkboxClass: 'icheckbox_square-aero',
   	    radioClass: 'iradio_square-aero'
    });
},1000);

function processResults(){
    trashContainer = $("#trash");
    
    console.log("all steps completed");
    trashContainer.children().remove();
    var totalWeight = 0, data = {};
    data.entry = {
        name: $("input[name=nickname]").val() + "," +
            $("input[name=age]").val() + "," +
            $("input[name=gender]").val() + "," +
            $("input[name=country]").val() + "," +
            $("select[name=occupation]").val()
    };
    data.values = [];
    for(var i=0; i<steps.length; i++){
        var step = $(steps[i]),
            durationSelect = step.find("select[name=duration]"),
            numberInput = step.find("input[name=quantity][type=text]");
        if(durationSelect.length > 0){
            //console.log(durationSelect.val());
            //console.log("weights");
            var toYear = durationSelect.val(),
                division = numberInput.val();
                sliders = step.find("input.bootstrapSlider");
            for(var j=0; j<sliders.length; j++){
                var slider = $(sliders[j]),
                    itemName = slider.parent().find(".lead").text(),
                    selectedQuantity = parseInt(slider.val()),
                    totalQuantity = Math.round(selectedQuantity * toYear / division),
                    weight = slider.attr("data-weight"),
                    img = slider.attr("data-img");
                if(slider.attr("data-parent")=="true"){
                    itemName = slider.parent().parent().find(".lead").first().text() + " - " + itemName;
                }
                //console.log("- " + slider.attr("data-weight") + " x " + slider.val());
                totalWeight += (weight * totalQuantity);
                if(selectedQuantity > 0){
                    if(img){
                        trashContainer.append("<tr><td><img src='img/plastic-items/"+img+"' height='100px'></td><td><h4>"+itemName+"</h4></td><td><h2 style='min-width:120px;'>X "+totalQuantity+"</h2></td></tr>");
                    }
                    data.values.push({
                        key: itemName,
                        value: totalQuantity
                    });
                }
            }
        }
    }
    var totalWeightKg = Math.round(totalWeight)/1000;
    $("#totalWeight").text(totalWeightKg + " KG");
    console.log("total = " + totalWeightKg);
    data.values.push({
        key: "totalWeightPerYearKg",
        value: totalWeightKg
    });
    
    $(".mascott").hide(); 
    if(totalWeightKg == 0){
        $("#trashTitle").hide();
    } else {
        $("#trashTitle").show();
    }
    if(totalWeightKg < 10){
        $(".mascott.good").show(); 
    } else if(totalWeightKg < 50){
        $(".mascott.ok").show(); 
    } else {
        $(".mascott.bad").show(); 
    }
    
    $.ajax({
        url: "/api/api.php/entries",
        method: "POST",
        contentType: "application/json",
        data: JSON.stringify(data.entry)
    }).done(function(response){
        console.log("response from saving entry: "+response);
        for(var i=0;i<data.values.length;i++){
            data.values[i].entry_id = response;
        }
        $.ajax({
            url: "/api/api.php/key_values",
            method: "POST",
            contentType: "application/json",
            data: JSON.stringify(data.values)
        }).done(function(response){
            console.log("response from saving key values: "+response);
        });
    });
}

$("button.forward").click(function(){
    console.log("forward");
    
    bootstrapSlider = $("input.bootstrapSlider").bootstrapSlider({
        tooltip: 'always',
        tooltip_position:'bottom'
    });
    
    if(steps.index($(".step.current")) >= steps.length-2){
        processResults();
    }

    $("html, body").animate({ scrollTop: jQuery("#top-wizard").children().first().offset().top + "px" });
});

$("button.backward").click(function(){
    $("html, body").animate({ scrollTop: jQuery("#middle-wizard").offset().top + "px" });
});