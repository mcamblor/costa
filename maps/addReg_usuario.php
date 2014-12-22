<?php

	$param1 = $_POST['nombre'];
	$param2 = $_POST['apellido_pat'];
	$param3 = $_POST['apellido_mat'];
	$param4 = $_POST['fecha_nac'];
	$param5 = $_POST['genero'];
	$param6 = $_POST['nombre_usuario'];
	$param7 = $_POST['correo_electronico'];
	$param8 = $_POST['clave'];
	$param9 = $_POST['anios_buceo'];
	$param10 = $_POST['hrs_buceo'];
	$param11 = $_POST['ciudad'];
	$param12 = $_POST['educacion'];
	$param13 = $_POST['experiencia'];
	$param14 = $_POST['region'];
	$param15 = $_POST['centro_buceo'];

	$link = mysqli_connect('localhost', 'costa_bd', 'costa_bd','costa_bd');
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$sql = "INSERT INTO  usuario VALUES ('".$param1."','".$param2."','".$param3."','".$param4."','".$param5."','".$param6."','".$param7."','".$param8."',".$param9.",'".$param10."','".$param11."','".$param12."','".$param13."',".$param14.",".$param15.")";
	if(mysqli_query($link,$sql)){
		session_start();
		$_SESSION["autentica"] = "SI";
		$_SESSION["usuarioactual"] = $param6; //nombre del usuario logueado.
?>
		<script>
		alert('Usuario creado con exito !');
		window.location.href='costa_home.php';
		</script>
<?php
	}
	else{
?>
		<script>
		alert('Ha ocurrido un problema con la creacion del usuario');
		window.location.href='costa_home.php';</script>
<?php
		}
	mysqli_close($link);
?>



