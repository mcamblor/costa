<?php
require_once("global.php");
require_once("bd.php");

session_start();

if(isset($_GET['function'])){
	switch ($_GET['function']) {
	    case "getBuceos":
	        echo getBuceos();
	        break;
	    case "getBuceoById":
	        echo getBuceoById($_GET['id']);
	        break;
        case "getHistorialByIdUsuario":
            echo getHistorialByIdUsuario($_SESSION["username"]);
            break;
	}
}

if(isset($_POST['function'])){
	switch ($_POST['function']) {
	    case "post":
	        echo postBuceo($_POST['buceo'], $_SESSION["username"]);
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

function postBuceo($buceo,$nombre_usuario){
    $object = json_decode($buceo, true);
    $link = connect_bd();
    $sql  = "INSERT INTO buceos VALUES (";
    $sql .= "NULL,"; //id
    $sql .= "'".$object['latitud']."',";
    $sql .= "'".$object['longitud']."',";
    $sql .= "'',"; //Localidad
    $sql .= "'".$object['fecha']."',";
    $sql .= "'".$object['tipo']."',";
    $sql .= "'".$object['temp_superficie']."',";
    $sql .= "'".$object['temp_fondo']."',";
    $sql .= "'".$object['tiempo']."',";
    $sql .= "'".$object['prof_media']."',";
    $sql .= "'".$object['prof_maxima']."',";
    $sql .= "'".$object['visibilidad']."',";
    $sql .= "'".$object['corriente']."',";
    $sql .= "'".$nombre_usuario."'";
    $sql .= ")";
    $result = mysqli_query($link,$sql);
    if (!$result)
    {
        $error = mysqli_error($link);
        $id = -1;
    }
    else
    {
        $error = "";
        $id = mysqli_insert_id($link);
    }
    disconnect_bd($link);
    return json_encode( array( 'valid' => $result, 'id' => $id,'error' => $error ) );
}
?>