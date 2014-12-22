<?php

$idusuario = $_POST['idusuario'];
$latitud = $_POST['latitud'];
$longitud = $_POST['longitud'];
$localidad = $_POST['localidad'];
$fecha = $_POST['fecha'];
$tipo_buceo = $_POST['tipo_buceo'];
$temp_superficie = $_POST['temp_superficie'];
$temp_fondo = $_POST['temp_fondo'];
$tiempo = $_POST['tiempo'];
$profundidad_media = $_POST['profundidad_media'];
$profundidad_maxima = $_POST['profundidad_maxima'];
$visibilidad = $_POST['visibilidad'];
$corriente = $_POST['corriente'];
$habitat = $_POST['habitat'];


$link = mysqli_connect('localhost', 'costa_bd', 'costa_bd','costa_bd');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$sql = "INSERT INTO  `registro_buceo` (`nombre_usuario`,`latitud`,`longitud`,`localidad`,`tipo`,`temp_superficie`,`temp_fondo`,`tiempo`,`profundidad_media`,`profundidad_maxima`,`visibilidad`,`corriente`) VALUES ('".$idusuario."',".$latitud.",".$longitud.",'".$localidad."',".$tipo_buceo.",".$temp_superficie.",".$temp_fondo.",".$tiempo.",".$profundidad_media.",".$profundidad_maxima.",".$visibilidad.",".$corriente.")";
mysqli_query($link,$sql);
printf ("%d", mysqli_insert_id($link));
mysqli_close($link);
?>
