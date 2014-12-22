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
            <h3 class="panel-title">Búsqueda de información</h3>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-4">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 clas="panel-title">Datos Básicos de Búsqueda</h5>
                  </div>
                </div>
                <!-- Form Group Datos-->
                <div class="panel-body">
                  <div class="col-md-12">
                    <div class="form-group">
                      <div class="col-md-12">
                        <label for="fecha_inicio" class="control-label col-xs-4" required>Fecha Inicio</label>
                        <div class="col-xs-8">
                          <input id="fecha_inicio" class="form-control position" type="date" placeholder="Fecha Inicio">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <label for="fecha_final" class="control-label col-xs-4" required>Fecha Final</label>
                        <div class="col-xs-8">
                          <input id="fecha_final" class="form-control position" type="date" placeholder="Fecha Final">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <label for="escala_temp" class="control-label col-xs-4" required>Escala Temporal</label>
                        <div class="col-xs-8">
                          <select>
                            <option value="1">Días</option>
                            <option value="2">Meses</option>
                            <option value="3">Años</option>
                          </select>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>           
                <!-- Fin Form Group Datos-->
                <!-- Botones Busqueda-->
                <div class="col-md-5">
                  <button id="submit-busqueda-c" type="button" class="btn btn-primary ">Realizar búsqueda</button>
                </div>
                <div class="col-md-5 col-md-offset-1">
                  <button id="submit-busqueda-c" type="button" class="btn btn-primary ">Realizar búsqueda</button>
                </div>
              <!-- Fin Botones Búsqueda -->
              </div>
              <!-- Mapa -->
              <div class="col-md-8">
                <div id="map-canvas-busqueda"></div>
              </div>
              <!-- Fin Mapa --> 
              <!-- Tabla Registros de Buceos-->
              <div class="panel-heading col-md-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h5 clas="panel-title">Resultado Registro de Buceos en Zona Específica</h5>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="row">
                    <div id="tabla-resultados" class="table-responsive col-md-12">
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
              </div>
              <!-- Fin Tabla de Registros de Buceo -->
            </div>
            <!-- Fin div class="row" -->
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