<?php

$nombre_comun = "Vacío";
$nombre_cientifico = "Vacío";
$kingdom = "Vacío";
$phylum = "Vacío";
$clase = "Vacío";
$order = "Vacío";
$family = "Vacío";
$genus = "Vacío";
$aphia = "Vacío";
$distribucion_geografica = "Vacío";
$descripcion = "Vacío";
$ecologia = "Vacío";
$importancia_economica = "Vacío";
$biologia_reproductiva = "Vacío";
$referencias = "Vacío";
$ruta = "Vacío";

if (isset($_GET["idEspecie"])){
  $idEspecie = $_GET["idEspecie"];

    $link = mysql_connect('localhost', 'costa_bd', 'costa_bd');
    if (!$link) {
        die('No pudo conectar: ' . mysql_error());
    }

    mysql_select_db("costa_bd",$link);

    $result = mysql_query("SELECT * FROM especie WHERE idEspecie = '{$idEspecie}' limit 1",$link);
    if($result!=NULL){
        if(mysql_num_rows($result)>0){
            $row = mysql_fetch_array($result);
            $nombre_comun = $row['nombre_comun'];
            $nombre_cientifico = $row['nombre_cientifico'];
            $kingdom = $row['kingdom'];
            $phylum = $row['phylum'];
            $clase = $row['class'];
            $order = $row['order'];
            $family = $row['family'];
            $genus = $row['genus'];
            $aphia = $row['aphia'];
			$distribucion_geografica = $row['distribucion_geografica'];
			$descripcion = $row['descripcion'];
			$ecologia = $row['ecologia'];
			$importancia_economica = $row['importancia_economica'];
			$biologia_reproductiva = $row['biologia_reproductiva'];
			$referencias = $row['referencias'];
			$ruta = $row['ruta'];
        }else{
        }
        mysql_free_result($result);
    }

    mysql_close($link);
}
?>

<h1><small>Ficha Especie</small></h1>

<div class="row">
  <div class="col-md-6">
    <!--<img src="<?php echo $ruta?>" class="img-responsive" alt="Responsive image">-->
	<img src="<?php echo $ruta ?>" class="img-responsive" alt="Responsive image">
  </div>
  <div class="col-md-6">
    <p><b>Nombre común:</b> <?php echo $nombre_comun?></p>
    <p><b>Nombre científico:</b> <?php echo $nombre_cientifico?></p>
    <p><b>Kingdom:</b> <?php echo $kingdom?></p>
    <p><b>Phylum:</b> <?php echo $phylum?></p>
    <p><b>Class:</b> <?php echo $clase?></p>
    <p><b>Order:</b> <?php echo $order?></p>
    <p><b>Family:</b> <?php echo $family?></p>
    <p><b>Genus:</b> <?php echo $genus?></p>
    <p><b>Aphia:</b> <?php echo $aphia?></p>
	<p><b>Distribución geográfica:</b> <?php echo $distribucion_geografica ?></p>
	<p><b>Descripción:</b> <?php echo $descripcion ?></p>
	<p><b>Ecología:</b> <?php echo $ecologia ?></p>
	<p><b>Importancia económica:</b> <?php echo $importancia_economica ?></p>
	<p><b>Biología Reproductiva:</b> <?php echo $biologia_reproductiva ?></p>
	<p><b>Referencias Bibliográficas:</b> <?php echo $referencias ?></p>
  </div>
</div>
                             		