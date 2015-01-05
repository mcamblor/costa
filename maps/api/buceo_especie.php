<?php
require_once("global.php");
require_once("bd.php");

echo getEspeciesByIdBuceo($_GET['buceos']);
                  
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

function getDensidadByIdEspecie(){
    /*
    $sql = "SELECT abundancia, COUNT( abundancia ) AS count
            FROM buceo_especie
            WHERE id_especie = 
            GROUP BY abundancia
            ORDER BY count DESC 
            LIMIT 1";
    $densidad = mysqli_query($link,$sql);
    if( mysqli_num_rows($densidad) > 0 ){
        $temp = mysqli_fetch_assoc($densidad);
        $row['abundancia'] = $temp['abundancia'];
    }
    */
}
?>