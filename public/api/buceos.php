<?php
require_once("global.php");
require_once("bd.php");

if(isset($_GET['function'])){
	switch ($_GET['function']) {
	    case "getBuceos":
	        echo getBuceos();
	        break;
	    case "getBuceoById":
	        echo getBuceoById($_GET['id']);
	        break;
        case "getHistorialByIdUsuario":
            echo getHistorialByIdUsuario($_GET['nombre_usuario']);
            break;
	}
}

function getBuceos(){
    
    $buceos = array();
    $link = connect_bd();
    $sql = "SELECT id, latitud, longitud, fecha FROM buceos";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($buceos, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    return json_encode($buceos);
}

function getBuceoById($id){

    $buceo = new stdClass();
    $link = connect_bd();
    $sql = "SELECT * FROM buceos WHERE id = ".$id." LIMIT 1";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        $buceo = mysqli_fetch_assoc($result);
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    
    return json_encode($buceo);
}


function getHistorialByIdUsuario($nombre_usuario){

    $dataArray = array();
    $link = connect_bd();
    $sql = "SELECT * FROM buceos WHERE nombre_usuario LIKE '".$nombre_usuario."'";
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($dataArray, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);

    $response = new stdClass();
    $response->data = $dataArray;
    return json_encode($response);
}
?>