<?php
$ne_lat = $_GET["ne_lat"];
$ne_lng = $_GET['ne_lng'];
$sw_lat = $_GET['sw_lat'];
$sw_lng = $_GET['sw_lng'];

$link = mysql_connect('localhost', 'costa_bd', 'costa_bd');
if (!$link) {
    die('No pudo conectar: ' . mysql_error());
}

mysql_select_db("costa_bd",$link);

$result = mysql_query("SELECT * FROM registro_buceo WHERE latitud >= {$sw_lat} and latitud <= {$ne_lat} and longitud >= {$sw_lng} and longitud <= {$ne_lng}",$link);
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

mysql_close($link);
?>