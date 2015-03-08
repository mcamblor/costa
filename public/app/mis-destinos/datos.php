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
        <div class="bb-alert alert alert-info col-md-6 col-md-offset-3" style="display:none;">
          <span></span>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">
            <span class="panel-title">
              <strong>Buceos <span class="badge"></span></strong>
            </span>
            <div class="btn-group pull-right">
              <button type="button" class="btn btn-primary btn-new" data-toggle="tooltip" data-placement="bottom" title="Agregar nueva">
                <span class="glyphicon glyphicon-plus"></span>
              </button>      
              <button type="button" class="btn btn-primary btn-refresh" data-toggle="tooltip" data-placement="bottom" title="Refrescar lista">
                <span class="glyphicon glyphicon-refresh"></span>
              </button>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table id="tabla-historial" class="table table-hover table-striped"></table>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- /container -->

    <script type="text/javascript" src="/all.js"></script>
  </body>
</html>