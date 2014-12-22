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