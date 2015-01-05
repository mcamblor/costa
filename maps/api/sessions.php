<?php
require_once("global.php");
require_once("bd.php");
if(isset($_POST['function'])){
	switch ($_POST['function']) {
	    case "login":
	        echo login();
	        break;
	    case "signup":
	        echo signup();
	        break;
	    case "logout":
	        echo logout();
	        break;
	}
}

function login(){
    $response = new stdClass();
    $link = connect_bd();
    $sql = "SELECT * FROM usuarios WHERE email='".$_POST['email']."' AND pass='".$_POST['pass']."' limit 1";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) != 0 ){
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["session"] = "true";
        $response->session="true";
        $response->usuario=$row;
        }
    else{
        $response->session="false";
        $response->problem="Usuario o contraseña incorrecta";
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    
    return json_encode($response);
}

function signup(){
    
    $link = connect_bd();

	$sql = "INSERT INTO  usuario VALUES (
    '".$_POST['nombre']."', 
    '".$_POST['apellido_pat']."', 
    '".$_POST['apellido_mat']."', 
    '".$_POST['fecha_nac']."', 
    '".$_POST['genero']."', 
    '".$_POST['nombre_usuario']."', 
    '".$_POST['correo_electronico']."', 
    '".$_POST['clave']."', 
    ".$_POST['anios_buceo'].", 
    '".$_POST['hrs_buceo']."', 
    '".$_POST['ciudad']."', 
    '".$_POST['educacion']."', 
    '".$_POST['experiencia']."', 
    ".$_POST['region'].", 
    ".$_POST['centro_buceo'].")";
	if(mysqli_query($link,$sql)){
		session_start();
		$_SESSION["session"] = "true";
		$_SESSION["usuarioactual"] = $_POST['nombre_usuario'];
        $result->$session="true";
	}
	else{
        $result->$session="false";
    }
    return json_encode($result);
}

function logout(){
    session_start();
    session_unset();
    session_destroy();
    $response = new stdClass();
    $response->session="false";
    return json_encode($response);
}

?>