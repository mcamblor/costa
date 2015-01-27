<?php

$link = mysql_connect('localhost', 'costa_bd', 'costa_bd');
if (!$link) {
    die('No pudo conectar: ' . mysql_error());
}

mysql_select_db("costa_bd",$link);

$result = mysql_query("SELECT * FROM registro_buceo WHERE nombre_usuario LIKE '".$usuario."'",$link);
if($result!=NULL){
    if(mysql_num_rows($result)>0){
       while($row=mysql_fetch_array($result)){
          //here you can work with the results...

        echo "<tr id='".$row['idregistro_buceo']."'>\n<td><input type='checkbox' class='cb' value='".$row['idregistro_buceo']."'></td>\n<td>".$row['latitud']."</td>\n<td>".$row['longitud']."</td>\n<td>".$row['localidad']."</td>\n<td>".$row['fecha']."</td>\n<td>".$row['tipo']."</td></tr>\n";
       }
    }else{
	}
	mysql_free_result($result);
}

mysql_close($link);
?>