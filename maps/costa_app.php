<?php
include("costa_seguridad.php");
$usuario = $_SESSION["usuarioactual"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro Especies</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<link rel="stylesheet" href="css/style.css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
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

/* Home */

/* Registro */

var idregistro_buceo;

var top20_especies = "<?php include('costa_getEspecies20.php'); ?>";
var all_especies = "<?php include('costa_getEspecies.php'); ?>";

//Inicializar Mapa
var map_registro;
var map_busqueda;
var rectangle;
var marker;
var infoWindow;
var busqueda_ne;
var busqueda_sw;
var markers = [];

function map_registro_init() {
  var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
  var mapOptions = {
    center: myLatLng,
    zoom: 5,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  };
  map_registro = new google.maps.Map(document.getElementById('map-canvas-registro'),
      mapOptions);

  marker = new google.maps.Marker({
    position: myLatLng,
    draggable:true,
    animation: google.maps.Animation.DROP
  });

  google.maps.event.addListener(map_registro, 'dblclick', function(e) {
    placeMarker(e.latLng);
  });

  google.maps.event.addListener(marker, 'mouseover', function(e) {
    getPositionMarker(e.latLng);
    //this.setAnimation(google.maps.Animation.BOUNCE);
  });
}

function placeMarker(position) {
  //map.panTo(position);
  marker.setPosition(position);
  marker.setMap(map_registro);
  getPositionMarker(position);
}

function getPositionMarker (position){
  document.getElementById('latitud').value = position.lat();
  document.getElementById('longitud').value = position.lng();
}

google.maps.event.addDomListener(window, 'load', map_registro_init);

/* Mapa Búsqueda */

function map_busqueda_init() {
  var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
  var mapOptions = {
    center: myLatLng,
    zoom: 5
  };
  map_busqueda = new google.maps.Map(document.getElementById('map-canvas-busqueda'), mapOptions);
  // [START region_rectangle]
  var bounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-32.992, -71.587),
      new google.maps.LatLng(-32.192, -70.787)
  );

  // Define a rectangle and set its editable property to true.
  rectangle = new google.maps.Rectangle({
    bounds: bounds,
    editable: true,
    draggable: true
  });

  rectangle.setMap(map_busqueda);
    // Add an event listener on the rectangle.
  // Define an info window on the map.
  infoWindow = new google.maps.InfoWindow();
  google.maps.event.addListener(rectangle, 'bounds_changed', showNewRect);

}
// Show the new coordinates for the rectangle in an info window.

/** @this {google.maps.Rectangle} */
function showNewRect(event) {
  busqueda_ne = rectangle.getBounds().getNorthEast();
  busqueda_sw = rectangle.getBounds().getSouthWest();
/*
  var contentString = '<b>Rectangle moved.</b><br>' +
      'New north-east corner: ' + busqueda_ne.lat() + ', ' + busqueda_ne.lng() + '<br>' +
      'New south-west corner: ' + busqueda_sw.lat() + ', ' + busqueda_sw.lng();

  // Set the info window's content and position.
  infoWindow.setContent(contentString);
  infoWindow.setPosition(busqueda_ne);

  infoWindow.open(map_busqueda);
  */
}
// [END region_rectangle]

google.maps.event.addDomListener(window, 'load', map_busqueda_init);


/*Fin Mapa Búsqueda*/

/* Historial */

$(document).ready(function() {

  $('.corriente').tooltip({
    trigger: "hover"
  });

  $('#submit-reg-buceo').click(function(){

      var btn = $(this);
      btn.button('loading');
      var longitud = $('#longitud').val();
      var latitud = $('#latitud').val();
      var localidad = $('#localidad').val();
      var fecha = $('#fecha').val();
      var tipo_buceo = $('#tipo-buceo').val();
      var temp_superficie = $('#temp-superficie').val();
      var temp_fondo = $('#temp-fondo').val();
      var tiempo = $('#tiempo').val();
      var profundidad_maxima = $('#profundidad-maxima').val();
      var profundidad_media = $('#profundidad-media').val();
      var visibilidad = $('#visibilidad').val();
      var corriente = $('#corriente').val();
      var habitat = $('#habitat').val();


      
      $.ajax({
        url: 'addReg_buceo.php',
        type: 'POST',
        async: true,
        data: {
          idusuario: idusuario,
          latitud: latitud,
          longitud: longitud,
          localidad: localidad,
          fecha: fecha,
          tipo_buceo: tipo_buceo,
          temp_superficie: temp_superficie,
          temp_fondo: temp_fondo,
          tiempo: tiempo,
          profundidad_media: profundidad_media,
          profundidad_maxima: profundidad_maxima,
          visibilidad: visibilidad,
          corriente: corriente,
          habitat: habitat
        },
        success: function(respuesta){

          if(respuesta!=0){
              idregistro_buceo = respuesta;
              btn.button('reset');
              $('#reg-modal').modal();
              $('#reg-modal').on('hidden.bs.modal', function (e) {
                $('#form-buceo :input').prop('disabled', true);
                $('#collapse-buceo').removeClass('in').addClass('out');
                $('#collapse-especie').removeClass('out').addClass('in');
              });
              
          }
          else {
             $('#reg-err-modal').modal();
             btn.button('reset');
          }

        }
      });
  });

 


  $('#submit-busqueda').click(function(){
      $.ajax({
        url: 'costa_getBusqueda-zona.php',
        type: 'GET',
        dataType: 'json',
        async: true,
        data: {ne_lat: busqueda_ne.lat(), ne_lng: busqueda_ne.lng(), sw_lat: busqueda_sw.lat(), sw_lng: busqueda_sw.lng() },
        success: function(respuesta){
          var x=0;
          $.each(respuesta, function(i,item){
            var myLatLng = new google.maps.LatLng(item.latitud, item.longitud);
            var marker = new google.maps.Marker({
              position: myLatLng,
              title: item.idespecie,
              map: map_busqueda
            });
            
            var contentString = '<b>Especie: '+ item.idespecie +'</b><br>' +
                'Latitud: ' + item.latitud + '<br>' +
                'Longitud: ' + item.longitud;
            var infoWindow = new google.maps.InfoWindow();
            // Set the info window's content and position.
            infoWindow.setContent(contentString);
            google.maps.event.addListener(marker, 'click', function() {
              infoWindow.open(map_busqueda,marker);
            });
            rectangle.setDraggable(false);
            markers[x] = marker;
            x++;
          });

        },
        error: function(e){
          alert("Error en la búsqueda");
        }
      });
  });
$('#submit-nueva-busqueda').click(function(){
  rectangle.setDraggable(true);
  for (x=0;x<markers.length;x++){
        markers[x].setMap(null);
        markers[x]= null;
  }
});

  

  $('.position').change(function(){
    var lat = $('#latitud').val();
    var lng = $('#longitud').val();
    var myLatLng = new google.maps.LatLng(lat, lng);
    marker.setPosition(myLatLng);
  });

  

}); //Fin (document).ready

</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>
<?php
include("costa_header.php");
?>
<div class="caja col-xs-8 col-xs-offset-2">
	<h1> Sistema de registro y búsqueda </h1>
	<h2>Usuario <small><?php echo $usuario ?></small></h2>
	<a href="costa_logOut.php" class="btn btn-primary">Salir</a>
</div>


<div class="caja tabbable col-xs-8 col-xs-offset-2">
   <ul class="nav nav-tabs" id="mytab">
      <li><a href="#tab1" data-toggle="tab">Home</a></li>
      <li class="active"><a href="#tab2" data-toggle="tab">Registro</a></li>
      <li><a href="#tab3" data-toggle="tab">Búsqueda</a></li>
      <li><a href="#tab4" data-toggle="tab">Historial</a></li>
   </ul>
   <br>

   <div class="tab-content">
      <div class="tab-pane" id="tab1">
        <div class="container">
            <div class="row form-group product-chooser">
            
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="product-chooser-item selected">
                  <img src="http://renswijnmalen.nl/bootstrap/desktop_mobile.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Registro de visualizaciones">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <span class="title">Registro de visualizaciones</span>
                    <span class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</span>
                    <input type="radio" name="product" value="registro" checked="checked">
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="product-chooser-item">
                  <img src="http://renswijnmalen.nl/bootstrap/desktop.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Búsqueda de visualizaciones">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <span class="title">Búsqueda de visualizaciones</span>
                    <span class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</span>
                    <input type="radio" name="product" value="busqueda">
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
              
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="product-chooser-item">
                  <img src="http://renswijnmalen.nl/bootstrap/mobile.png" class="img-rounded col-xs-4 col-sm-4 col-md-12 col-lg-12" alt="Revisa tu historial de registros">
                        <div class="col-xs-8 col-sm-8 col-md-12 col-lg-12">
                    <span class="title">Historial de visualizaciones</span>
                    <span class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</span>
                    <input type="radio" name="product" value="Historial">
                  </div>
                  <div class="clear"></div>
                </div>
              </div>
                
            </div>
        </div>
      </div>

      
      <div class="tab-pane active" id="tab2">
        
          <!-- Registro de Visualizaciones-->
          <div class="container-fluid">
            <div class="row">
              <div id="cont-registro" class="col-md-12">

                <ol class="breadcrumb">
                  <li><a href="#">Inicio</a></li>
                  <li class="active">Registro</li>
                </ol>

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
								<div class="col-md-8 col-md-offset-2" id="map-canvas-registro"></div>

								<div class="form-group">
									<label for="latitud" class="control-label col-xs-2" required>Latitud</label>
									<div class="col-xs-3">
										<div class="input-group">
										  <input id="latitud" class="form-control" type="text" placeholder="Latitud">
										  <span class="input-group-addon">°</span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="longitud" class="control-label col-xs-2" required>Longitud</label>
									<div class="col-xs-3">
									  <div class="input-group">
										  <input id="longitud" class="form-control position" type="text" placeholder="Longitud">
										  <span class="input-group-addon">°</span>
									  </div>
									</div>
								</div>
								<div class="form-group">
									<label for="localidad" class="control-label col-xs-2" required>Localidad</label>
									<div class="col-xs-6">
										<div class="input-group">
											<input id="localidad" class="form-control position" type="text" placeholder="Localidad">
										</div>
									</div>
								</div>
							</div>
						</div>
					
					<div class="panel panel-default">
						<div class="panel-heading">
                          <h3 class="panel-title">Información Buceo</h3>
                        </div>
                        <div class="panel-body">
							<div class="form-group">
								  <label for="fecha" class="control-label col-xs-2" required>Fecha</label>
								  <div class="col-xs-10">
									<div class="input-group">
										<input id="fecha" class="form-control position" type="date" placeholder="Fecha">
									</div>
								  </div>
							</div>
							<div class="form-group">
							  <label for="tipo-buceo" class="control-label col-xs-2">Tipo de buceo</label>
							  <div class="col-xs-10">
								<select id="tipo-buceo" class="form-control">
									<option value="1">Autónomo deportivo</option>
									<option value="2">Semi-Autónomo</option>
									<option value="3">Apnea</option>
									<option value="4">Técnico</option>
								</select>
							  </div>
							</div>

							<div class="form-group">
								<label for="tiempo" class="control-label col-xs-2" required>Tiempo</label>
								<div class="col-xs-10">
									<div class="input-group">
										<input id="tiempo" class="form-control position" type="number">
										<span class="input-group-addon">min</span>
									</div>
								</div>
							</div>

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Temperatura</h3>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                              <label for="temp-superficie" class="control-label col-xs-2" required>Superficie</label>
                              <div class="col-xs-3">
                                <div class="input-group">
                                    <input id="temp-superficie" class="form-control position" type="number">
                                    <span class="input-group-addon">°C</span>
                                </div>
                              </div>
                              <label for="temp-fondo" class="control-label col-xs-2" required>Fondo</label>
                              <div class="col-xs-3">
                                <div class="input-group">
                                    <input id="temp-fondo" class="form-control position" type="number">
                                    <span class="input-group-addon">°C</span>
                                </div>
                              </div>
                          </div>

                        </div>
                      </div>
                      <!--Fin Panel Temperatura-->

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title">Profundidad</h3>
                        </div>
                        <div class="panel-body">
                          <div class="form-group">
                              <label for="profundidad-media" class="control-label col-xs-2" required>Prof. media</label>
                              <div class="col-xs-3">
                                <div class="input-group">
                                    <input id="profundidad-media" class="form-control position" type="number">
                                    <span class="input-group-addon">metros</span>
                                </div>
                              </div>
                              <label for="profundidad-maxima" class="control-label col-xs-2" required>Prof. máxima</label>
                              <div class="col-xs-3">
                                <div class="input-group">
                                    <input id="profundidad-maxima" class="form-control position" type="number">
                                    <span class="input-group-addon">metros</span>
                                </div>
                              </div>
                          </div>
                        </div>
                      </div>

                      <!--Fin Panel Profundidad-->

                      <div class="form-group">
                          <label for="visibilidad" class="control-label col-xs-2">Visibilidad</label>
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
                          <div class="col-xs-4">
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
                      </div>
                      
                      <div class="form-group">
                          <label for="habitat" class="control-label col-xs-2 habitat" data-placement="top" data-toggle="tooltip" title="Indique el habitat y sustrato que se registro en la mayor parte del buceo">Hábitat</label>
                          <div class="col-xs-8">
                            <select id="habitat" class="form-control">
                                <?php
                                include("costa_getHabitat.php");
                                ?>
                            </select>
                          </div>
                      </div>

                      <div class="form-group">
                          <div class="col-xs-offset-3 col-xs-8">
                              <button id="submit-reg-buceo" type="button" data-loading-text="Procesando solicitud..." class="btn btn-primary">Ingresar Registro</button>
                          </div>
                      </div>
                  </div> 
              </div> <!--Fin Información Buceo-->
            </form>
            </div>
          </div>
          </div> <!--Fin Registro Buceo-->

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

            </div> <!--container-registro-->
          </div> <!--row-->
        </div> <!--container fluid-->
      <!-- Fin Registro de Buceo-->

    </div><!--Fin tab2-->
     
      <div class="tab-pane" id="tab3">
      <!--Búsqueda de Visualizaciones-->
      <h2>Búsqueda<small>Seleccione un área rectangular en el mapa e ingrese(opcionalmente) los filtros necesarios para su búsqueda.</small></h2>
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-6 col-md-4">
              <button id="submit-busqueda" type="button" class="btn btn-primary">Realizar búsqueda</button>
              <button id="submit-nueva-busqueda" type="button" class="btn btn-primary">Nueva búsqueda</button>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-8">
              <div id="map-canvas-busqueda"></div>
            </div>
          </div>
        </div>
      <!--Fin Búsqueda de Visualizaciones-->
      </div>

      <div class="tab-pane" id="tab4">

      <!--Historial de Visualizaciones-->
      <h2>Historial<small>Registros realiados</small></h2>
          <div class="table-responsive">
            <table class="table table-condensed">
              <thead>
                <tr>
                  <th>id</th>
                  <th>idespecie</th>
                  <th>idusuario</th>
                  <th>latitud</th>
                  <th>latitud</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include("costa_getHistorial.php");
                ?>
              </tbody>
            </table>
          </div>
      <!--Fin Historial de Visualizaciones-->

      </div>

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