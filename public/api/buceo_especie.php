<?php
require_once("global.php");
require_once("bd.php");

if(isset($_GET['function'])){
    switch ($_GET['function']) {
        case "getEspeciesByIdBuceo":
            echo getEspeciesByIdBuceo($_GET['buceos']);
            break;
        case "getDensidadByIdEspecie":
            echo getDensidadByIdEspecie($_GET['densidad'],$_GET['buceos']);
            break;
    }
}

                  
function getEspeciesByIdBuceo($ids){
    $especies = array();
    $link = connect_bd();
    $sql = "SELECT be.id_especie as id, e.nombre_comun, COUNT(be.id_especie) as count FROM buceo_especie as be LEFT JOIN especies as e ON be.id_especie = e.id WHERE be.id_buceo IN (".$ids.") GROUP BY id_especie";
     $result = mysqli_query($link,$sql);
    if( mysqli_num_rows($result) > 0 ){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($especies, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);
    
    return json_encode($especies);
}

function getDensidadByIdEspecie($ids_especies, $id_buceos){
    $densidad = array();
    $link = connect_bd();
    $sql = "SELECT be.id_especie, e.nombre_comun, be.abundancia +0 AS abundancia, COUNT( be.abundancia ) AS count FROM buceo_especie AS be LEFT JOIN especies AS e ON be.id_especie = e.id WHERE id_buceo IN  (".$id_buceos.") AND be.id_especie IN (".$ids_especies.") AND be.abundancia IS NOT NULL GROUP BY be.abundancia, be.id_especie";
    //$sql = "SELECT be.id_especie, e.nombre_comun, MAX(be.abundancia +0) AS abundancia, COUNT( be.abundancia ) AS count FROM buceo_especie AS be LEFT JOIN especies AS e ON be.id_especie = e.id WHERE id_buceo IN (".$id_buceos.") AND be.id_especie IN (".$ids_especies.") AND be.abundancia IS NOT NULL GROUP BY be.id_especie";
    $result = mysqli_query($link,$sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($densidad, $row);
        }
    }
    mysqli_free_result($result);
    disconnect_bd($link);

    return json_encode($densidad);
}
?>