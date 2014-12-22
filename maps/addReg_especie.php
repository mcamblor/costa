<?php
$idregistro_buceo = $_POST['idregistro_buceo'];
$contador = $_POST['contador'];
$arreglo=array();

$sql = "INSERT INTO  `registro_especie` (`idregistro_buceo`,`idEspecie`) VALUES ";
for ($i=1; $i < $contador; $i++) { 
	$temp =  $_POST['idespecie_'.$i];
	$arreglo[$i-1]= $temp;
	$sql = $sql."(".$idregistro_buceo.",".$temp."),";
}
$temp =  $_POST['idespecie_'.$i];
$arreglo[$i-1]= $temp;
$sql = $sql."(".$idregistro_buceo.",".$temp.")";
$link = mysqli_connect('localhost', 'costa_bd', 'costa_bd','costa_bd');
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (mysqli_query($link, $sql) === TRUE) {
    echo "ok";
}
mysqli_close($link);


?>