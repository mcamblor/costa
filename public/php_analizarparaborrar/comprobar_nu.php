<?php

$nombre_usuario = $_GET['nombre_usuario'];

$myusuario = mysql_query("SELECT nombre_usuario FROM usuario WHERE nombre_usuario='".$nombre_usuario."' limit 1");
$nmyusuario = mysql_num_rows($myusuario);

?>