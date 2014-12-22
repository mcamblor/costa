<?php

$usuario = $_POST['usuario'];
$pass = $_POST['clave_'];

/* A continuación, realizamos la conexión con nuestra base de datos en MySQL */
$link = mysql_connect("localhost","costa_bd","costa_bd");
if (!$link) {
    die('No pudo conectar: ' . mysql_error());
}

mysql_select_db("costa_bd");

$myusuario = mysql_query("SELECT nombre_usuario FROM usuario WHERE nombre_usuario='{$usuario}' limit 1");
$nmyusuario = mysql_num_rows($myusuario);

//Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario…
if($nmyusuario != 0){
$myclave = mysql_query("SELECT nombre_usuario FROM usuario WHERE nombre_usuario='{$usuario}' AND clave={$pass} limit 1");
$nmyclave = mysql_num_rows($myclave);

//Si el usuario y clave ingresado son correctos (y el usuario está activo en la BD), creamos la sesión del mismo.
if($nmyclave != 0){
session_start();
//Guardamos dos variables de sesión que nos auxiliará para saber si se está o no “logueado” un usuario
$_SESSION["autentica"] = "SI";
$_SESSION["usuarioactual"] = mysql_result($myclave,0,0); //nombre del usuario logueado.

//Direccionamos a nuestra página principal del sistema.
header ("Location: costa_home.php");
}
else{
?>
<script>
alert('Contrasenia incorrecta.');
window.location.href='costa_home.php';</script>
<?php
}
}
else{
?>
<script>alert('El usuario no existe.');
window.location.href='costa_home.php';</script>
<?php
}
mysql_close($link);
?>