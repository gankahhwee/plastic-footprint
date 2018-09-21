<?php

$servername = "localhost";
$username = "ryanphun_plastic";
$password = "LovedEarth2016!";
$dbname = "ryanphun_plastic_footprint";
 
// connect to the mysql database
$link = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($link,'utf8');
    
$sql = "SELECT entries.id as 'ID', email as 'Email', name as 'Name', key_values.key as 'Item', key_values.value as 'Value', key_values.remark as 'Remark', CONVERT_TZ(timestamp, 'SYSTEM', '+08:00') as 'Timestamp' FROM `entries`, `key_values` WHERE entries.id = key_values.entry_id ORDER BY entries.id, key_values.id";

// excecute SQL statement
$result = mysqli_query($link,$sql);

// die if SQL statement failed
if (!$result) {
  http_response_code(404);
  die(mysqli_error($link));
}

$list = array();
$fields = array('ID','Email','Details', 'Timestamp', 'totalWeightPerYearKg', 'totalQuantityPerYear');
$selectionFields = array();

for ($i=0;$i<mysqli_num_rows($result);$i++) {
    $obj = mysqli_fetch_object($result);
    
    $key = str_replace(',' ,' ', $obj->Item);
    $key_remark = $key . ' <Notes>';
    if(!in_array($key, $fields) && !in_array($key, $selectionFields)){
        array_push($selectionFields, $key);
        array_push($selectionFields, $key_remark);
    }
    $id = $obj->ID;
    if(!array_key_exists($id, $list)){
        $list[$id] = array();
        $list[$id]['ID'] = $id;
        $list[$id]['Email'] = $obj->Email;
        $list[$id]['Details'] = str_replace(',',' | ',$obj->Name);
        $list[$id]['Timestamp'] = $obj->Timestamp;
    }
    $list[$id][$key] = $obj->Value;
    $list[$id][$key_remark] = $obj->Remark;
}
mysqli_free_result($result);
// close mysql connection
mysqli_close($link);

asort($selectionFields);
$fields = array_merge($fields,$selectionFields);

$filename = "results.csv";
$file = fopen($filename, "w") or die("Unable to open file!");

for ($i=0;$i<count($fields);$i++) {
    fwrite($file, $fields[$i] . ',');
}
fwrite($file, "\n");
foreach(array_keys($list) as $id){
    for ($j=0;$j<count($fields);$j++) {
    	if(array_key_exists($fields[$j],$list[$id])){
            fwrite($file, $list[$id][$fields[$j]]);
        }
        fwrite($file, ',');
    }
    fwrite($file, "\n");
}

fclose($file);

if (file_exists($filename)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filename));
    readfile($filename);
    exit;
}

?>