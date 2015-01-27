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
    $sql = "SELECT id_especie as id, COUNT(id_especie) as count FROM buceo_especie WHERE id_buceo IN (".$ids.") GROUP BY id_especie";
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
    $sql = "SELECT id_especie, abundancia+0 as abundancia, COUNT( abundancia ) AS count FROM buceo_especie WHERE id_buceo IN (".$id_buceos.") AND id_especie IN (".$ids_especies.") AND abundancia IS NOT NULL GROUP BY abundancia, id_especie";
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