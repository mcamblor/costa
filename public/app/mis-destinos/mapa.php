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
        <div id="map"></div>
        <div id="opciones" class="controladores opciones col-md-10 col-md-offset-2">
          <div class="btn-group " role="group" aria-label="...">
            <button type="button" class="btn-new btn btn-primary  active">
              <strong><span class="glyphicon glyphicon-plus"></span> Nuevo</strong>
            </button>
            <button type="button" class="btn-edit btn btn-primary">
              <strong><span class="glyphicon glyphicon-pencil"></span> Ver y editar</strong>
            </button>
          </div>
        </div>
        <div id="instrucciones" class="controladores col-md-4 col-md-offset-8">
            <div id="instruccion" class="alert alert-info alert-dismissible" role="alert">
              <strong>Hola,</strong> para comenzar el registro de un buceo, debes seleccionar en el mapa la posición donde se realizó.
            </div>
        </div>
        <div id="sidebar" class="controladores col-md-2" style="display:none">
            <div class="panel">
              <div class="panel-heading"><h4>Información Geográfica</h4></div>
              <div class="panel-body">
                  <p><strong>Latitud</strong></p><p><span id="latitud"></span>°</p>
                  <p><strong>Longitud</strong></p><p><span id="longitud"></span>°</p>
                  <br>
                  <button id="btn-continuar" type="button" class="btn btn-info btn-block">Continuar</button>
              </div>
            </div>
        </div>
      </div>
    </div> <!-- /container -->

    <script type="text/javascript" src="/all.js"></script>
  </body>
</html>