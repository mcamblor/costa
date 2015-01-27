<?php
include("costa_seguridad.php");
$usuario = $_SESSION["usuarioactual"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Costa Humboldt - Búsqueda de Información</title>
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
              <li><a href="costa_historial.php">Historial</a></li>
            </ul>
            <p class="navbar-text navbar-right"><a href="costa_logOut.php" class="navbar-link"><span class="glyphicon glyphicon-off"></span></a></p>
            <p class="navbar-text navbar-right">Bienvenido <?php echo $usuario;?></p>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">Búsqueda de información</h4>
          </div>
          <div class="panel-body">
              <div class="col-md-12">
                <div id="map-canvas-busqueda"></div>
              </div>
              <div class="col-md-12">
                <button id="submit-busqueda-c" type="button" class="btn btn-primary">Realizar búsqueda</button>
                <button id="submit-nueva-busqueda-c" type="button" class="btn btn-primary">Nueva búsqueda</button>
              </div>
              <div id="tabla-resultados" class="table-responsive">
                <table class="table table-condensed">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>latitud</th>
                      <th>longitud</th>
                      <th>localidad</th>
                      <th>fecha</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
          </div>
      </div>

    </div> <!-- /container -->


<div class="footer">
  <div class="container">
    <p class="text-muted">Desarrollado por Manija.</p>
  </div>
</div>

</body>
</html>                                     