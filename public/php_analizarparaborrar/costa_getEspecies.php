<?php
require_once("global.php");
require_once("bd.php");

if(isset($_GET['function'])){
	switch ($_GET['function']) {
	    case "getEspecies":
	        echo getEspecies();
	        break;
	    case "getTop20":
	        echo getTop20();
	        break;
	    case "getEspecieById":
	        echo getEspecieById($_GET['id']);
	        break;
	}
}

function getTop20(){
    $especies = array();
    $link = connect_bd();
    $sql = "SELECT id, nombre_comun, nombre_cientifico FROM especies ORDER BY aphia DESC LIMIT 20";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($especies, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    
    return json_encode($especies);
}

function getEspecies(){
    $especies = array();
    $link = connect_bd();
    $sql = "SELECT id, nombre_comun, nombre_cientifico FROM especies";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($especies, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    
    return json_encode($especies);
}

function getEspecieById($id){

    $especie = new stdClass();
    $link = connect_bd();
    $sql = "SELECT * FROM especies WHERE id = ".$id." LIMIT 1";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        $especie = mysqli_fetch_assoc($result));
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    
    return json_encode($especie);
}
?>