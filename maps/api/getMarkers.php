<?php
    require_once("global.php");
    require_once("bd.php");

    $buceos = array();
    $link = connect_bd();
    $sql = "SELECT id, latitud, longitud FROM buceos";
    $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($buceos, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    echo json_encode($buceos);
?>