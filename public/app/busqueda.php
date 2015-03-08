<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Costa Humboldt</title>
  <link rel="icon" type="image/jpg" href="/img/favicon.png" />
  <link rel="stylesheet" href="/all.css">
</head>
<body>
	<div class="container-fluid">
		<?php include realpath($_SERVER["DOCUMENT_ROOT"])."/app/blocks/header.html"; ?>
		<div class="app-content">
			<div id="map-busqueda"></div>
			<div id="instrucciones" class="controladores col-md-4 col-md-offset-8">
				<div id="instruccion" class="alert alert-info alert-dismissible" role="alert">
					<strong>Hola,</strong> para realizar una búsqueda, debes generar un polígono marcando los vértices en el mapa la posición que deseas. Además puedes seleccionar uno de los filtros para tu búsqueda.
				</div>
			</div>

			<div id="sidebar" class="controladores col-sm-3">
				<div class="panel">
					<div id="filtro1" class="panel-heading">
						<h4>Filtro de Fechas:  <input id="filtro-fechas" class="BSswitch" data-size="mini" name="filtro-fecha" type="checkbox" checked=""></h4>
						<div class="panel-body">
							<form id="busquedaZona">
								<div class="form-group">
									<label>Fecha Inicio</label>
									<input id="fechaInicio" name="fechaInicio"  class="form-control" type="date" placeholder="Fecha">
									<label>Fecha Fin</label>
									<input id="fechaFin" name="fechaFin" class="form-control" type="date" placeholder="Fecha">
								</div>
							</form>
						</div>
					</div>
					<div id="filtro2" class="panel-heading">
						<h4>Filtro por Especies:  <input id="filtro-especies" class="BSswitch" data-size="mini" name="filtro-especies" type="checkbox" checked=""></h4>
						<div class="panel-body">
							<form id="busquedaEspecies" role="search">
								<div class="form-group">
									<input id="especie-busqueda-autocomplete" name="especie-busqueda-autocomplete" type="text" class="form-control" placeholder="Especies">
								</div>
							</form>
						</div>
					</div>
					<div id="filtro3" class="panel-heading">
						<h4>Filtro por Regiones:  <input id="filtro-region" class="BSswitch" data-size="mini" name="filtro-region" type="checkbox" checked=""></h4>
						<div class="panel-body">
							<form id="busquedaRegiones" role="search">
								<div class="form-group">
									<select id="region-busqueda-autocomplete" class="form-control" name="region-busqueda-autocomplete"></select>
								</div>
							</form>
						</div>
					</div>
					<button id="btn-continuar" type="button" class="btn btn-info btn-md center-block">Continuar</button>
				</div>
			</div>
		</div>
	</div> <!-- /container -->

	<script type="text/javascript" src="/all.js"></script>
</body>
</html>