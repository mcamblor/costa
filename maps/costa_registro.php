<?php
include("costa_seguridad.php");
$usuario = $_SESSION["usuarioactual"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Costa Humboldt - Registro de Buceo</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="js/jscosta.js"></script>

<!--Fancybox-->
<link rel="stylesheet" href="fancybox/jquery.fancybox-1.3.4.css">
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<!--Fancybox-->



<script>

/* General */
var idusuario = '<?php echo $usuario;?>';

/*Variables para Registro de Especies*/
var top20_especies = "<?php include('costa_getEspecies20.php'); ?>";
var all_especies = "<?php include('costa_getEspecies.php'); ?>";
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
              <li ><a href="costa_home.php">Home</a></li>
              <li class="active"><a href="#">Registro</a></li>
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
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-buceo">
                Registro de Buceo
              </a>
            </h4>
          </div>
          <div id="collapse-buceo" class="panel-collapse collapse in">

          <div class="panel-body">
              <form id="form-buceo" class="form-horizontal">

              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Información Geográfica</h3>
                </div>
                <div class="panel-body">

                  <div class="row">
                      <div class="col-md-4">

                          <div class="col-xs-12">
                            <p> <strong>Haz doble click en el mapa para seleccionar las coordenadas:</strong></p><br>
                          </div>

                          <div class="form-group">
                            <label for="latitud" class="control-label col-xs-4"><p class="text-center">Latitud</p></label>
                            <div class="col-xs-8">
                              <div class="input-group">
                                <input id="latitud" class="form-control" type="text" placeholder="Latitud">
                                <span class="input-group-addon">°</span>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="longitud" class="control-label col-xs-4"><p class="text-center">Longitud</p></label>
                            <div class="col-xs-8">
                              <div class="input-group">
                                <input id="longitud" class="form-control position" type="text" placeholder="Longitud">
                                <span class="input-group-addon">°</span>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="localidad" class="control-label col-xs-4"><p class="text-center">Localidad</p></label>
                            <div class="col-xs-8">
                                <input id="localidad" class="form-control position" type="text" placeholder="Localidad">
                            </div>
                          </div>

                      </div>
                      <div class="col-md-8"><div id="map-canvas-registro"></div></div>
                  </div>
                </div>
              </div>
              <!--Fin Panel Información Geográfica-->

              <!--Panel Información General-->
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title">Información General</h3>
                </div>
                <div class="panel-body">

                  <div class="form-group">
                      <label for="fecha" class="control-label col-xs-2" required>Fecha</label>
                      <div class="col-xs-3">
                        <input id="fecha" class="form-control position" type="date" placeholder="Fecha">
                      </div>

                    <label for="tipo-buceo" class="control-label col-xs-2">Tipo de buceo</label>
                    <div class="col-xs-3">
                    <select id="tipo-buceo" class="form-control">
                      <option value="1">Autónomo deportivo</option>
                      <option value="2">Semi-Autónomo</option>
                      <option value="3">Apnea</option>
                      <option value="4">Técnico</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="tiempo" class="control-label col-xs-2" required>Tiempo
                      <button type="button" class="btn btn-default btn-xs popover_reg" data-container="body" data-toggle="popover" data-placement="top" data-content="Detalle el total de tiempo que permaneció en el fondo. Si realizó buceos repetitivos sume el total de tiempo de fondo de los buceos. Si realizó buceo apnea indique el tiempo total de buceo. ">
                          <span class="glyphicon glyphicon-info-sign"></span>
                      </button>
                      </label>                 
                      <div class="col-xs-2">
                        <div class="input-group">
                          <input id="tiempo" class="form-control position" type="number">
                          <span class="input-group-addon">min</span>
                        </div>
                      </div>

                      <label for="visibilidad" class="control-label col-xs-offset-1 col-xs-2">Visibilidad
                      <button type="button" class="btn btn-default btn-xs popover_reg" data-container="body" data-toggle="popover" data-placement="top" data-content="Indique la visibilidad horizontal estimada o medida, donde la mayor parte del muestreo fue realizado.">
                          <span class="glyphicon glyphicon-info-sign"></span>
                      </button>
                      </label>
                      <div class="col-xs-3">
                        <select id="visibilidad" class="form-control">
                            <option value="1">Menos de 1 metro</option>
                            <option value="2">1 - 3 metros</option>
                            <option value="3">3 - 5 metros</option>
                            <option value="4">5 - 10 metros</option>
                            <option value="5">10 - 15 metros</option>
                            <option value="6">15 - 20 metros</option>
                            <option value="7">20 - 30 metros</option>
                            <option value="8">Mas de 30 metros</option>
                        </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="corriente" class="control-label col-xs-2">Corriente</label>
                      <div class="col-xs-3">
                        <label class="radio-inline">
                          <input type="radio" class="corriente" id="corriente" name="corriente" value="1" data-placement="top" data-toggle="tooltip" title="Corriente suave a inperceptible"> Ninguna
                        </label>
                        <label class="radio-inline">
                          <input type="radio" class="corriente" id="corriente" name="corriente" value="2" data-placement="top" data-toggle="tooltip" title="Corriente suave perceptible que no afecta mayormente el buceo"> Suave
                        </label>
                        <label class="radio-inline">
                          <input type="radio" class="corriente" id="corriente" name="corriente" value="3" data-placement="top" data-toggle="tooltip" title="Corriente que dificulta el nado y genera 'acarreo' del buzo."> Fuerte
                        </label>
                      </div>

                      <label for="habitat" class="control-label col-xs-2 habitat" data-placement="top" data-toggle="tooltip" title="Indique el habitat y sustrato que se registro en la mayor parte del buceo">Hábitat</label>
                      <div class="col-xs-3">
                        <select id="habitat" class="form-control">
                            <?php
                            include("costa_getHabitat.php");
                            ?>
                        </select>
                      </div>
                  </div>                  
        
                  <div class="row">
                    <div class="col-md-6">
                        <!--Panel Temperatura-->
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">Temperatura
                                <button type="button" class="btn btn-default btn-xs popover_reg" data-container="body" data-toggle="popover" data-placement="top" data-content="Si registró la temperatura con termómetro, indique los valores">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </h3>
                      </button>                            
                          </div>
                          <div class="panel-body">
                            <div class="form-group">
                                <label for="temp-superficie" class="control-label col-xs-2" required>Superficie</label>
                                <div class="col-xs-4">
                                  <div class="input-group">
                                      <input id="temp-superficie" class="form-control position" type="number">
                                      <span class="input-group-addon">°C</span>
                                  </div>
                                </div>
                                <label for="temp-fondo" class="control-label col-xs-2" required>Fondo</label>
                                <div class="col-xs-4">
                                  <div class="input-group">
                                      <input id="temp-fondo" class="form-control position" type="number">
                                      <span class="input-group-addon">°C</span>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <!--Fin Panel Temperatura-->
                    </div>

                    <div class="col-md-6">
                        <!--Panel Profundidad-->
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h3 class="panel-title">Profundidad
                                <button type="button" class="btn btn-default btn-xs popover_reg" data-container="body" data-toggle="popover" data-placement="top" data-content="Indique la profundidad media a la que se realizó la mayor parte del muestreo y profundidad máxima registrada">
                                <span class="glyphicon glyphicon-info-sign"></span>
                            </h3>
                          </div>
                          <div class="panel-body">
                            <div class="form-group">
                                <label for="profundidad-media" class="control-label col-xs-2" required>Media</label>
                                <div class="col-xs-4">
                                  <div class="input-group">
                                      <input id="profundidad-media" class="form-control position" type="number">
                                      <span class="input-group-addon">metros</span>
                                  </div>
                                </div>
                                <label for="profundidad-maxima" class="control-label col-xs-2" required>Máxima</label>
                                <div class="col-xs-4">
                                  <div class="input-group">
                                      <input id="profundidad-maxima" class="form-control position" type="number">
                                      <span class="input-group-addon">metros</span>
                                  </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <!--Fin Panel Profundidad-->
                    </div>
                  </div>

                </div>                
              </div> <!--Fin Panel Información Buceo-->              
              </form>
          </div> <!--Fin panel-body-->
        </div> <!--Fin collapse-->
          <div class="panel-footer">
              <button id="submit-reg-buceo" type="button" class="btn btn-info">
                  <span class="glyphicon glyphicon-floppy-disk"></span>
              </button>
          </div>
      </div> <!--Fin Panel Registro Buceo-->


      <!--PANEL REGISTRO ESPECIE-->
      <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-especie">
                Registro de Especie
              </a>
            </h4>
          </div>

          <div id="collapse-especie" class="panel-collapse collapse out">
              <div class="panel-body">
                <form id="form-especie" class="form-horizontal">
                  <div id="item_especies">
                    <div id="especie_1" class="form-group">
                        <label for="select-especie" class="control-label col-xs-3">Especie</label>
                        <div class="col-xs-6">
                          <select id="1" class="form-control select-especie">
                              <option value="0" selected>Seleccione especie</option>
                              <optgroup label="Top 20">
                                <?php
                                include("costa_getEspecies20.php");
                                ?>
                              </optgroup>
                              <optgroup label="Todos">
                                <?php
                                include("costa_getEspecies.php");
                                ?>
                              </optgroup>
                          </select>
                        </div>
                        <div class="col-xs-2">
                            <a id="especie_1" class="fancybox" href="#">Ver Ficha</a>
                        </div>
                        <div class="col-xs-1">
                            <a href="#" class="eliminar_ficha">&times;</a>
                        </div>
                    </div>
                  </div>
                </form>
                <div class="form-group">
                  <div class="col-xs-12">
                      <button type="button" id="submit-reg-especie" class="btn btn-default btn-lg">
                          <span class="glyphicon glyphicon-floppy-disk"></span>
                      </button>
                      <button type="button" id="agregarCampo" class="btn btn-info">
                          <span class="glyphicon glyphicon-plus"></span>
                      </button>
                  </div>
                </div>
              </div> <!--Body panel-->
          </div>
      </div><!-- Fin Panel Registro Especie-->

    </div> <!-- /container -->

    <div class="footer">
      <div class="container">
        <p class="text-muted">Desarrollado por Manija.</p>
      </div>
    </div>

    <div class="modal fade" id="reg-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Respuesta de solicitud</h4>
          </div>
          <div class="modal-body">
            <p>Registro realizado con éxito</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Ok!</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="reg-err-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Respuesta de solicitud</h4>
          </div>
          <div class="modal-body">
            <p>Ha ocurrido un problema con la recepción de los datos, inténtalo nuevamente.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Ok!</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</body>
</html>                                 		