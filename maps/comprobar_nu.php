<?php

$nombre_usuario = $_GET['nombre_usuario'];

/* A continuación, realizamos la conexión con nuestra base de datos en MySQL */
$link = mysql_connect("localhost","costa_bd","costa_bd");
if (!$link) {
    die('No pudo conectar: ' . mysql_error());
}

mysql_select_db("costa_bd");

$myusuario = mysql_query("SELECT nombre_usuario FROM usuario WHERE nombre_usuario='".$nombre_usuario."' limit 1");
$nmyusuario = mysql_num_rows($myusuario);
mysql_close($link);
echo $nmyusuario;
?>