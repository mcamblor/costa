<?php

	$temp_array_registros = $_POST["array_registros"];
	$array_registros = explode(",", $temp_array_registros);

	$con=mysqli_connect("localhost","costa_bd","costa_bd","costa_bd");
	// Check connection
	if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$flag = 1;
	foreach ($array_registros as &$registro) {
	    if (mysqli_query($con,"DELETE FROM registro_buceo WHERE idregistro_buceo=".$registro)) {$flag = 1;}
	    else {$flag = 0;}
	}
	mysqli_close($con);
	
	echo $flag;
?>
