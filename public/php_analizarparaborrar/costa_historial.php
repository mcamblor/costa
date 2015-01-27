<?php
include("costa_seguridad.php");
$usuario = $_SESSION["usuarioactual"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Costa Humboldt - Historial de Registros</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jscosta.js"></script>

<!--Fancybox-->
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css">
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<!--Fancybox-->


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>

/* General */
var idusuario = '<?php echo $usuario;?>';

</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<div class="container">

      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://costahumboldt.noip.me/costa/"><img src="img/cb_logo.png"></a>
          </div>
          <div class="navbar-collapse collapse" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="costa_home.php">Home</a></li>
              <li><a href="costa_registro.php">Registro</a></li>
              <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Búsqueda<span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="costa_busqueda_simple.php">Búsqueda simple</a></li>
		            <li><a href="costa_busqueda_comparativa.php">Búsqueda comparativa</a></li>
		          </ul>
		      </li>
              <li class="active"><a href="#">Historial</a></li>
            </ul>
            <p class="navbar-text navbar-right"><a href="costa_logOut.php" class="navbar-link"><span class="glyphicon glyphicon-off"></span></a></p>
            <p class="navbar-text navbar-right">Bienvenido <?php echo $usuario;?></p>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Historial de registros</h4>
          </div>
          <div id="tabla-historial" class="panel-body">
              <div class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th><input type="checkbox" id="checkbox-all"></th>
                      <th>Latitud</th>
                      <th>Longitud</th>
                      <th>Localidad</th>
                      <th>Fecha</th>
                      <th>Tipo</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include("costa_getHistorial.php");
                    ?>
                  </tbody>
                </table>
              </div>
          </div>
          <div class="panel-footer">
              <button type="button" id="delReg" class="btn btn-info">
                  <span class="glyphicon glyphicon-trash"></span>
              </button>
          </div>
      </div>

    </div> <!-- /container -->


<div class="footer">
  <div class="container">
    <p class="text-muted">Desarrollado por Manija.</p>
  </div>
</div>

<div class="modal fade" id="del-modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Respuesta de solicitud</h4>
      </div>
      <div class="modal-body">
        <p>Se han eliminado los registros seleccionados</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Ok!</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>
</html>                                     