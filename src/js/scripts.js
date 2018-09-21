
var steps = $(".step"), bootstrapSlider, trashContainer;

setTimeout(function(){
    $("div.step.hidden").removeClass("hidden");
    
    bootstrapSlider = $("input.bootstrapSlider").bootstrapSlider({
        tooltip: 'always',
        tooltip_position:'bottom'
    });
},1000);

function processResults(){
    trashContainer = $("#trash");
    
    console.log("all steps completed");
    trashContainer.children().remove();
    var totalWeight = 0, totalQuantity = 0, byoSaveWeight = 0, data = {};
    data.entry = {
        name: $("input[name=nickname]").val() + "," +
            $("input[name=age]").val() + "," +
            $("input[name=gender]:checked").val() + "," +
            $("input[name=country]").val() + 
            ($("select[name=occupation]").val() ? ("," + $("select[name=occupation]").val()) : ""),
        email: $("input[name=email]").val()
    };
    console.log(data.entry);
    data.values = [];
    for(var i=0; i<steps.length; i++){
        var step = $(steps[i]),
            durationSelect = step.find("select[name=duration]"),
            numberInput = step.find("input.qty[type=text]");
        if(durationSelect.length > 0){
            //console.log(durationSelect.val());
            //console.log("weights");
            var toYear = parseFloat(durationSelect.val()),
                division = numberInput.val();
                sliders = step.find("input.bootstrapSlider");
            for(var j=0; j<sliders.length; j++){
                var slider = $(sliders[j]),
                    itemName = slider.parent().find(".lead").text(),
                    selectedQuantity = parseInt(slider.val()),
                    quantityPerYear = Math.round(selectedQuantity * toYear / division),
                    weight = parseFloat(slider.attr("data-weight")),
                    img = slider.attr("data-img");
                if(slider.attr("data-parent")=="true"){
                    itemName = slider.parent().parent().find(".lead").first().text() + " - " + itemName;
                }
                //console.log("- " + slider.attr("data-weight") + " x " + slider.val());
                if(selectedQuantity > 0){
                    
                    var totalItemWeight = (weight * quantityPerYear);
                    totalWeight += totalItemWeight;
                    totalQuantity += quantityPerYear;
                    
                    var byo = slider.attr("data-byo");
                    if(byo){
                        byoSaveWeight += totalItemWeight;
                    }
                    var remark = selectedQuantity + " x " + toYear + " / " + division + " x " + weight + "g = " + 
                                 quantityPerYear + " x " + weight + "g = " + Math.round(weight * quantityPerYear)/1000 + "kg";
                    if(img){
                        trashContainer.append("<tr><td><img src='img/plastic-items/"+img+"' height='100px'></td>"+
                                              "<td style='min-width:200px;'><h4>"+itemName+"</h4></td>"+
                                              "<td style='min-width:120px;'><h2>X "+quantityPerYear+"</h2></td>"+
                                              "<td style='min-width:120px;' class='trash-remark'>"+remark+
                                              ("<br/>("+(totalWeight/1000)+"kg accummulated)</td>")+
                                              "<td style='min-width:120px;' class='suggestion'>" +
                                                (byo ? ("<h3 class='byo'>BYO<br/><strong>"+byo+"</strong>") : "") +
                                                (slider.attr("data-refill") ? ("<h3 class='refill'>Choose<br/><strong>REFILLS</strong>") : "") +
                                                (slider.attr("data-refuse") ? ("<h3 class='refuse'><strong>REFUSE</strong>") : "") +
                                                (slider.attr("data-reuse") ? ("<h3 class='reuse'><strong>REUSE</strong>") : "") +
                                                (slider.attr("data-recycle") ? ("<h3 class='recycle'><strong>RECYCLE</strong>") : "") +
                                              "</h3></td>"+
                                              "</tr>");
                    }
                    data.values.push({
                        key: itemName,
                        value: quantityPerYear,
                        remark: remark
                    });
                }
            }
        }
    }
    
    if(totalWeight > 0){
        trashContainer.prepend("<tr style='background: #eee;'><th></th>"+
                              "<th></th>"+
                              "<th></th>"+
                              "<th class='trash-remark'></th>"+
                              "<th><h3>Suggestion:</h3></th>"+
                              "</tr>");
    }
    
    $("#userNickname").text($("input[name=nickname]").val().toUpperCase()+", ");
    
    var totalWeightKg = Math.round(totalWeight/100)/10;
    $("#totalWeight").html("<u>"+totalWeightKg + "</u> KG");
    console.log("total weight = " + totalWeightKg);
    
    $("#totalQuantity").html("<u>"+totalQuantity + "</u> pieces");
    console.log("total quantity = " + totalQuantity);
    
    data.values.push({
        key: "totalWeightPerYearKg",
        value: totalWeightKg
    });
    data.values.push({
        key: "totalQuantityPerYear",
        value: totalQuantity
    });
    
    $(".mascott").hide(); 
    $(".speech").hide(); 
    
    $("#trashTitle").show();
    if(totalWeightKg == 0){
        $("#trashTitle").hide();
    }
    
    $(".byo").show();
    $(".byo h2").text(Math.round(byoSaveWeight/100)/10 + " KG");
    if(byoSaveWeight == 0){
        $(".byo").hide();
    }
    
    if(totalWeightKg < 5/* && totalQuantity < 200*/){
        $(".mascott.good").show(); 
        $(".speech-5").show();
        
    } else if(totalWeightKg < 20/* && totalQuantity < 600*/){
        $(".mascott.ok").show(); 
        
        if(totalWeightKg < 10/* && totalQuantity < 400*/){
            $(".speech-4").show();
        } else {
            $(".speech-3").show();
        }
        
    } else {
        if(totalWeightKg < 30/* && totalQuantity < 800*/){
            $(".mascott.bad").show(); 
            $(".speech-2").show();
        } else {
            $(".mascott.worst").show(); 
            $(".speech-1").show();
        }
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
        console.log(data.values);
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
    
    if(steps.index($(".step.current")) >= steps.length-2){
        processResults();
    }

    $("html, body").animate({ scrollTop: jQuery("#top-wizard").children().first().offset().top + "px" });
});

$("button.backward").click(function(){
    $("html, body").animate({ scrollTop: jQuery("#middle-wizard").offset().top + "px" });
});