<?php
$ne_lat = $_GET["ne_lat"];
$ne_lng = $_GET['ne_lng'];
$sw_lat = $_GET['sw_lat'];
$sw_lng = $_GET['sw_lng'];

$ne_lat2 = $_GET["ne_lat2"];
$ne_lng2 = $_GET['ne_lng2'];
$sw_lat2 = $_GET['sw_lat2'];
$sw_lng2 = $_GET['sw_lng2'];



$link = mysql_connect('localhost', 'costa_bd', 'costa_bd');
if (!$link) {
    die('No pudo conectar: ' . mysql_error());
}

mysql_select_db("costa_bd",$link);

$result_count_area1 = mysql_query("SELECT count(rb.idregistro_buceo) as cant_buceos from registro_buceo as rb WHERE rb.latitud >= {$sw_lat} and rb.latitud <= {$ne_lat} and rb.longitud >= {$sw_lng} and rb.longitud <= {$ne_lng}",$link);

$result_count_area2 = mysql_query("SELECT count(rb.idregistro_buceo) as cant_buceos from registro_buceo as rb WHERE rb.latitud >= {$sw_lat2} and rb.latitud <= {$ne_lat2} and rb.longitud >= {$sw_lng2} and rb.longitud <= {$ne_lng2}",$link);

if($result_count_area1!=NULL){
    if(mysql_num_rows($result_count_area1)>0){
       while($row=mysql_fetch_array($result_count_area1)){
    		echo "Cuadro 1 {$row['cant_buceos']}\n";
       }
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result_count_area1);
}

if($result_count_area2!=NULL){
    if(mysql_num_rows($result_count_area2)>0){
       while($row=mysql_fetch_array($result_count_area2)){
    		echo "Cuadro 2 {$row['cant_buceos']}\n";
       }
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result_count_area2);
}

$result_area1 = mysql_query("SELECT te.nombre_comun, re.idespecie, AVG(re.abundancia) as abundancia, count(re.idespecie) as conta FROM registro_buceo as rb left join registro_especie as re on rb.idregistro_buceo = re.idregistro_buceo left join especie as te on re.idespecie = te.idespecie WHERE rb.latitud >= {$sw_lat} and rb.latitud <= {$ne_lat} and rb.longitud >= {$sw_lng} and rb.longitud <= {$ne_lng} group by re.idespecie",$link);

$result_area2 = mysql_query("SELECT te.nombre_comun, rb.idregistro_buceo, re.idespecie, AVG(re.abundancia) as abundancia, count(re.idespecie) as conta FROM registro_buceo as rb left join registro_especie as re on rb.idregistro_buceo = re.idregistro_buceo left join especie as te on re.idespecie = te.idespecie WHERE (rb.latitud >= {$sw_lat2} and rb.latitud <= {$ne_lat2} and rb.longitud >= {$sw_lng2} and rb.longitud <= {$ne_lng2}) and not (rb.latitud >= {$sw_lat} and rb.latitud <= {$ne_lat} and rb.longitud >= {$sw_lng} and rb.longitud <= {$ne_lng}) and re.idespecie is not null group by re.idespecie",$link);

if($result_area2!=NULL){
    if(mysql_num_rows($result_area2)>0){
       while($row=mysql_fetch_array($result_area2)){
    		echo "idregistrobuceo:{$row['idregistro_buceo']}- nombrecomun{$row['nombre_comun']}-idespecie{$row['idespecie']}-conta{$row['conta']}-abundancia{$row['abundancia']}\n";
       }
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result_area2);
}

/*
$result3 = mysql_query("SELECT te.nombre_comun, re.idespecie, AVG(re.abundancia) as abundancia, count(re.idespecie) as conta FROM registro_buceo as rb left join registro_especie as re on rb.idregistro_buceo = re.idregistro_buceo left join especie as te on re.idespecie = te.idespecie WHERE (rb.latitud >= {$sw_lat2} and rb.latitud <= {$ne_lat2} and rb.longitud >= {$sw_lng2} and rb.longitud <= {$ne_lng2}) or (rb.latitud >= {$sw_lat} and rb.latitud <= {$ne_lat} and rb.longitud >= {$sw_lng} and rb.longitud <= {$ne_lng}) group by re.idespecie",$link);

if($result3!=NULL){
    if(mysql_num_rows($result3)>0){
       while($row=mysql_fetch_array($result3)){
    		echo "{$row['nombre_comun']}-{$row['idespecie']}-{$row['conta']}-{$row['abundancia']}\n";
       }
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result3);
}
*/

/*if($result3!=NULL){
	echo mysql_result($result3,0,0);
    $count_buceos = mysql_result($result3,0,0);
    mysql_free_result($result3);
}*/

/*
$result = mysql_query("SELECT * FROM registro_buceo WHERE latitud >= {$sw_lat} and latitud <= {$ne_lat} and longitud >= {$sw_lng} and longitud <= {$ne_lng}",$link);

$result2 = mysql_query("SELECT * FROM registro_buceo WHERE latitud >= {$sw_lat2} and latitud <= {$ne_lat2} and longitud >= {$sw_lng2} and longitud <= {$ne_lng2}",$link);


if($result2!=NULL){
    if(mysql_num_rows($result2)>0){
       while($row=mysql_fetch_array($result2)){
          //here you can work with the results...
        $output[]=$row;
       }
       //print(json_encode($output));
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result2);
}


if($result!=NULL){
    if(mysql_num_rows($result)>0){
       while($row=mysql_fetch_array($result)){
          //here you can work with the results...
        $output[]=$row;
       }
       print(json_encode($output));
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result);
}
*/


mysql_close($link);
?>