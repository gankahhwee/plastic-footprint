<?php

$servername = "localhost";
$username = "ryanphun_plastic";
$password = "LovedEarth2016!";
$dbname = "ryanphun_plastic_footprint";

// get the HTTP method, path and body of the request
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$method = $_SERVER['REQUEST_METHOD'];
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
 
$input = json_decode(file_get_contents('php://input'),true);
 
// connect to the mysql database
$link = mysqli_connect($servername, $username, $password, $dbname);
mysqli_set_charset($link,'utf8');

function executeQuery($object, $link, $table, $method, $request){
    // retrieve the table and key from the path
    $key = array_shift($request)+0;
    
    if($object){
        // escape the columns and values from the input object
        $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($object));
        $values = array_map(function ($value) use ($link) {
        if ($value===null) return null;
            return mysqli_real_escape_string($link,(string)$value);
        },array_values($object));

        // build the SET part of the SQL command
        $set = '';
        for ($i=0;$i<count($columns);$i++) {
            $set.=($i>0?',':'').'`'.$columns[$i].'`=';
            $set.=($values[$i]===null?'NULL':'"'.$values[$i].'"');
        }
    }
    
    // create SQL based on HTTP method
    switch ($method) {
      case 'GET':
        $sql = "select * from `$table`".($key?" WHERE id=$key":''); break;
      case 'PUT':
        $sql = "update `$table` set $set where id=$key"; break;
      case 'POST':
        $sql = "insert into `$table` set $set"; break;
      case 'DELETE':
        $sql = "delete from `$table` where id=$key"; break;
    }
    //echo $sql;

    // excecute SQL statement
    $result = mysqli_query($link,$sql);

    // die if SQL statement failed
    if (!$result) {
      http_response_code(404);
      die(mysqli_error($link));
    }

    // print results, insert id or affected row count
    if ($method == 'GET') {
      if (!$key) echo '[';
      for ($i=0;$i<mysqli_num_rows($result);$i++) {
        echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
      }
      if (!$key) echo ']';
    } elseif ($method == 'POST') {
      echo mysqli_insert_id($link);
    } else {
      echo mysqli_affected_rows($link);
    }
}

if($table == 'key_values' && $method == 'POST'){
    for ($i=0;$i<count($input);$i++) {
        executeQuery($input[$i], $link, $table, $method, $request);
    }
} else {
    executeQuery($input, $link, $table, $method, $request);
    
}
 
// close mysql connection
mysqli_close($link);

?>