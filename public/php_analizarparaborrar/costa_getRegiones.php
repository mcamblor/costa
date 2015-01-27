<?php

$link = mysql_connect('localhost', 'costa_bd', 'costa_bd');
if (!$link) {
    die('No pudo conectar: ' . mysql_error());
}

mysql_select_db("costa_bd",$link);

$result = mysql_query("SELECT idregion, nombre FROM region WHERE 1",$link);
if($result!=NULL){
    if(mysql_num_rows($result)>0){
       while($row=mysql_fetch_array($result)){
    		echo "<option value='{$row['idregion']}'>{$row['nombre']}</option>";
       }
    }else{
       //no results, you can put a message here...
    }
    mysql_free_result($result);
}

mysql_close($link);
?>