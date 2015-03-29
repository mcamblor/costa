<?php
require_once("global.php");
require_once("bd.php");

session_start();
$nombre_usuario = $_SESSION["username"];

if(isset($_GET['function'])){
	switch ($_GET['function']) {
	    case "comprobarNombreUsuario":
	        echo comprobarNombreUsuario($_GET['nombre_usuario']);
	        break;
        case "comprobarEmail":
            echo comprobarEmail($_GET['email']);
            break;
	}
}
elseif(isset($_POST['function'])){
    switch ($_POST['function']) {
        case "nuevoUsuario":
            echo nuevoUsuario($_POST['usuario']);
            break;
        case "cambiarPassword":
            echo cambiarPassword($nombre_usuario, $_POST['currentPassword'], $_POST['newPassword']);
            break;
    }
}

function comprobarNombreUsuario($nombre_usuario){
  
    $link = connect_bd();
    $sql = "SELECT nombre_usuario FROM usuarios WHERE nombre_usuario='".$nombre_usuario."' limit 1";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ) $isAvailable = false;
    else $isAvailable = true;
  
    mysqli_free_result($result);
    disconnect_bd($link);
  
    echo json_encode(array(
        'valid' => $isAvailable
    ));
}

function comprobarEmail($email){
    $link = connect_bd();
    $sql = "SELECT email FROM usuarios WHERE email='".$email."' limit 1";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ) $isAvailable = false;
    else $isAvailable = true;
    
    mysqli_free_result($result);
    disconnect_bd($link);
  
    echo json_encode(array(
        'valid' => $isAvailable
    ));
}

function nuevoUsuario($usuario){
    $user = json_decode($usuario, true);
    $link = connect_bd();
    $sql  = "INSERT INTO usuarios VALUES (";
    $sql .= "'".$user['nombre']."',";
    $sql .= "'".$user['apellido_pat']."',";
    $sql .= "'".$user['apellido_mat']."',";
    $sql .= "'".$user['fecha_nac']."',";
    $sql .= "'".$user['genero']."',";
    $sql .= "'".$user['nombre_usuario']."',";
    $sql .= "'".$user['email']."',";
    $sql .= "MD5('".$user['pass']."'),";
    $sql .= "'".$user['anios_buceo']."',";
    $sql .= "'".$user['hrs_buceo']."',";
    $sql .= "'".$user['ciudad']."',";
    $sql .= "'".$user['educacion']."',";
    $sql .= "'".$user['experiencia']."',";
    $sql .= "'".$user['regiones']."',";
    $sql .= "'".$user['centro_buceo']."'";
    $sql .= ")";
    $result = mysqli_query($link,$sql);
    disconnect_bd($link);
    return json_encode( array( 'valid' => $result ) );
}

function cambiarPassword($usuario, $currentPassword, $newPassword){
    $link = connect_bd();
    $sql  = "UPDATE usuarios SET pass = '".$newPassword."' WHEN pass = '".$currentPassword."' and nombre_usuario = '".$usuario;
    $result = mysqli_query($link,$sql);
    disconnect_bd($link);
    return json_encode( array( 'valid' => $result ) ); 
}
?>