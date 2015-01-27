<?php
function connect_bd(){

    //Variables de conexión a base de datos
    $name_bd="costa_humboldt";
    $user_bd="costa_humboldt";
    $pass_bd="costa_humboldt";
    $host_bd="localhost";
    
    $link = mysqli_connect($host_bd, $user_bd, $pass_bd, $name_bd);
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
      return NULL;
    }
    mysqli_set_charset($link, "utf8");
    return $link;
}

// Desconectar 
function disconnect_bd( $link ){
    mysqli_close($link);
}
?>