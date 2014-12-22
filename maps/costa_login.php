<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Costa Humboldt</title>
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script> 


</head>
<body>
<!--<h1>Costa Humboldt</h1>-->
<?php
include("costa_header.php");
?>

<div class="panel panel-default col-md-8 col-md-offset-2">
    <div class="panel-heading">
      <h3 class="panel-title">Ingreso de Usuario</h3>
    </div>
    <div class="panel-body">
        <div class="bs-example">
            <form action="costa_validate.php" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="inputUsuario" class="control-label col-xs-2">Nombre usuario</label>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="inputUsuario" name="usuario" placeholder="Nombre usuario">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label col-xs-2">Contraseña</label>
                    <div class="col-xs-10">
                        <input type="password" class="form-control" id="inputPassword" name="clave_" placeholder="Clave">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <div class="checkbox">
                            <label><input type="checkbox"> Recuérdame</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel panel-default col-md-8 col-md-offset-2">
    <div class="panel-heading">
      <h3 class="panel-title">Registro de Usuario</h3>
    </div>
    <div class="panel-body">
        <div class="bs-example">
            <form action="addReg_usuario.php" method="post" class="form-horizontal">

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

                <div class="form-group">
                    <label for="inputNombreUsuario-reg" class="control-label col-xs-2">Nombre Usuario</label>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="inputNombreUsuario-reg" name="nombre_usuario" placeholder="">
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

                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <div class="checkbox">
                            <label><input type="checkbox"> Leí las condiciones y servicios</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary">Regístrate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>                                 		