<?php

session_start();
header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
//$_SESSION['SKey'] = uniqid(mt_rand(), true);
//$_SESSION['IPaddress'] = ExtractUserIpAddress();
$_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];

if(isset($_SESSION["autentica"])){ $usuario = $_SESSION["usuarioactual"];}
else {$usuario="";}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Costa Humboldt</title>
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
              <li class="active"><a href="#">Home</a></li>
              	<?php 
	              if (isset($_SESSION["autentica"])){
            	?>
              <li><a href="costa_registro.php">Registro</a></li>
              <li><a href="costa_busqueda.php">Búsqueda</a></li>
              <li><a href="costa_historial.php">Historial</a></li>
            </ul>
            

            <p class="navbar-text navbar-right"><a href="costa_logOut.php" class="navbar-link"><span class="glyphicon glyphicon-off"></span></a></p>
            <p class="navbar-text navbar-right">Bienvenido <?php echo $usuario;?></p>
            <?php
            }
            else {
            ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <form action="costa_validate.php" method="post" class="navbar-form navbar-left" role="form">
                    <div class="form-group">
                        <input type="text" class="form-control input-sm" id="inputUsuario" name="usuario" placeholder="Nombre usuario">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control input-sm" id="inputPassword" name="clave_" placeholder="Clave">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label><input type="checkbox"> Recuérdame</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Iniciar sesión</button>
                </form>
                </li>
            </ul>
            <?php
            } 
            ?>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>


      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2>Sistema de almacenamiento de información de buceos</h2>
        <p>Te damos la bienvenida a nuestro nuevo sistema integrado de buceos, en la cual podrás registrar tus buceos realizados y las especies visualizadas. También podrás realizar búsquedas por especie y hacer comparaciones entre sectores a tu gusto.</p>
        <p>
          <!-- Button trigger modal -->
          <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#registro-modal">
            Regístrate
          </button>
        </p>
      </div>

      <div class="row">
          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img src="img/home_tn.jpg" class="img-thumbnail" alt="Registro de buceos">
              <div class="caption">
                <h3>Registro de buceos</h3>
                <p>Almacena toda la información necesaria de los buceos que has realizado, puedes registrar las especies visualizadas en tu buceo e indicar la abundancia.</p>
                <p><a href="costa_registro.php" class="btn btn-primary" role="button">Iniciar registro</a></p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img src="img/home_tn.jpg" class="img-thumbnail" alt="Búsqueda de información">
              <div class="caption">
                <h3>Búsqueda</h3>
                <p>Realiza búsquedas comparativas por sectores, filtra según alguna especie que te interese y mucho más.</p>
                <p><a href="costa_busqueda.php" class="btn btn-primary" role="button">Iniciar búsqueda</a></p>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img src="img/home_tn.jpg" class="img-thumbnail" alt="Historial de registros">
              <div class="caption">
                <h3>Historial</h3>
                <p>Acá podrás encontrar un completo informe con los registros que has realizado hasta el momento.</p>
                <p><a href="costa_historial.php" class="btn btn-primary" role="button">Revisar historial</a></p>
              </div>
            </div>
          </div>
      </div>

    </div> <!-- /container -->


<div class="footer">
  <div class="container">
    <p class="text-muted">Desarrollado por Manija.</p>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="registro-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Registro de usuario</h4>
      </div>
      <div class="modal-body">
          <form action="addReg_usuario.php" id="form-registro" method="post" class="form-horizontal">
              <div class="form-group">
                  <label for="inputNombre-reg" class="control-label col-xs-2">Nombre</label>
                  <div class="col-xs-10">
                      <input type="text" class="form-control" id="inputNombre-reg" name="nombre">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputApellidoMat-reg" class="control-label col-xs-2">Apellido Paterno</label>
                  <div class="col-xs-10">
                      <input type="text" class="form-control" id="inputApellidoMat-reg" name="apellido_pat">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputApellidoMat-reg" class="control-label col-xs-2">Apellido Materno</label>
                  <div class="col-xs-10">
                      <input type="text" class="form-control" id="inputApellidoMat-reg" name="apellido_mat">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputFechaNac-reg" class="control-label col-xs-2">Fecha Nacimiento</label>
                  <div class="col-xs-10">
                      <input type="text" class="form-control" id="inputFechaNac-reg" value="2014/05/05" name="fecha_nac">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputGenero-reg" class="control-label col-xs-2">Género</label>
                  <div class="col-xs-10">
                      <label class="radio-inline">
                        <input type="radio" class="genero" name="genero" value="Masculino" > Masculino
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="genero"  name="genero" value="Femenino" > Femenino
                      </label>
                  </div>
              </div>

              <div id="div-nombre_usuario" class="form-group">
                  <label for="inputNombreUsuario-reg" class="control-label col-xs-2">Nombre Usuario</label>
                  <div class="col-xs-10">
                      <input type="text" id="nombre_usuario" class="form-control" id="inputNombreUsuario-reg" name="nombre_usuario" placeholder="">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEmail-reg" class="control-label col-xs-2">Correo electrónico</label>
                  <div class="col-xs-10">
                      <input type="email" class="form-control" id="inputEmail-reg" name="correo_electronico" placeholder="">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputClave" class="control-label col-xs-2">Contraseña</label>
                  <div class="col-xs-10">
                      <input type="password" class="form-control" id="inputClave" name="clave" placeholder="Máx 9 caracteres">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputAnios-reg" class="control-label col-xs-2">Años de Buceo</label>
                  <div class="col-xs-10">
                      <input type="number" class="form-control" id="inputAnios-reg" name="anios_buceo">
                  </div>
              </div>

              <div class="form-group">
                  <label for="hrs-buceo" class="control-label col-xs-2">Horas de buceo</label>
                  <div class="col-xs-10">
                      <select id="hrs-buceo" class="form-control" name="hrs_buceo">
                          <option value="1">Menos de 10 horas</option>
                          <option value="2">11 - 30 horas</option>
                          <option value="3">31 - 60 horas</option>
                          <option value="4">61 - 100 horas</option>
                          <option value="5">101 - 300 horas</option>
                          <option value="6">+ 300 horas</option>
                      </select>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputCiudad-reg" class="control-label col-xs-2">Ciudad</label>
                  <div class="col-xs-10">
                      <input type="text" class="form-control" id="inputCiudad-reg" name="ciudad">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputEduc-reg" class="control-label col-xs-2">Educación</label>
                  <div class="col-xs-10">
                      <label class="radio-inline">
                        <input type="radio" class="educacion" name="educacion" value="Básica" > Básica
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="educacion"  name="educacion" value="Media" > Media
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="educacion"  name="educacion" value="Superior" > Superior
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="educacion"  name="educacion" value="Postítulo" > Postítulo
                      </label>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputExp-reg" class="control-label col-xs-2">Experiencia</label>
                  <div class="col-xs-10">
                      <label class="radio-inline">
                        <input type="radio" class="experiencia" name="experiencia" value="Novato" > Novato
                      </label>
                      <label class="radio-inline">
                        <input type="radio" class="experiencia"  name="experiencia" value="Experto" > Experto
                      </label>
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputRegion-reg" class="control-label col-xs-2">Región</label>
                    <div class="col-xs-10">
                      <select id="inputRegion-reg" class="form-control" name="region">
                          <?php
                          include("costa_getRegiones.php");
                          ?>
                      </select>
                    </div>
              </div>

              <div class="form-group">
                  <label for="inputCC-reg" class="control-label col-xs-2">Centro de Buceo</label>
                    <div class="col-xs-10">
                      <select id="inputCC-reg" class="form-control" name="centro_buceo">
                          <?php
                          include("costa_getCC.php");
                          ?>
                      </select>
                    </div>
              </div>

          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button id="btn-submit-registro" type="button" class="btn btn-primary">Registrarse</button>
      </div>
    </div>
  </div>
</div>

</body>
</html>                                 		