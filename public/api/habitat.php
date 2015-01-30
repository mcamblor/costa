<?php
require_once("global.php");
require_once("bd.php");

$tableName = "habitat";

if(isset($_GET['function'])){
	switch ($_GET['function']) {
	    case "get":
	        echo get();
	        break;
	}
}

function get(){
    global $tableName;
    $arrayData = array();
    $link = connect_bd();
    $sql = "SELECT * FROM ". $tableName." WHERE 1";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($arrayData, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    return json_encode($arrayData);
}

?>