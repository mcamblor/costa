/* REGISTRO DE BUCEO */

$(document).ready(function() {

	$('.corriente').tooltip({
		trigger: "hover"
	});

	$('.popover_reg').popover({
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
			      btn.children().removeClass('glyphicon-floppy-disk').addClass('glyphicon-floppy-saved');
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
	}); // #submit-reg-buceo click

	/* Control agregar especies */
	var MaxInputs       = 8; //maximum input boxes allowed
	var contenedor   	= $("#item_especies"); //Input boxes wrapper ID
	var AddButton       = $("#agregarCampo"); //Add button ID
	var contador = 1 ;

	$(AddButton).click(function () 
	{
			if(contador <= MaxInputs)
			{
				contador++;
				$('#item_especies').append('<div id="especie_'+ contador +'" class="form-group"><label for="select-especie" class="control-label col-xs-3">Especie</label><div class="col-xs-6"><select id="'+ contador +'" class="form-control select-especie"><option value="0" selected>Seleccione especie</option><optgroup label="Top 20">'+top20_especies+'</optgroup><optgroup label="Todos">'+ all_especies +'</optgroup></select></div><div class="col-xs-2"><a id="especie_'+ contador +'" class="fancybox" href="#">Ver Ficha</a></div><div class="col-xs-1"><a href="#" class="eliminar_ficha">&times;</a></div></div>');
				$('div#especie_'+ contador +' .eliminar_ficha').click(del_event);
				select_event();
			}
	return false;
	});

	function del_event(){
		if( contador >= 1 ) {
				var idcampo = $(this).parent().parent('div').prop('id').split("_");
				$(this).parent().parent('div').remove(); //remove text box
				var count = idcampo[1];
				count++;
				var aux;
				var temp;
				if(contador >= count){
					for(aux = count;aux<=contador;aux++){
						temp = aux - 1;
						$('div#especie_'+aux).prop('id','especie_' + temp);
						$('select#'+aux).prop('id',temp);
						$('a#especie_'+aux).prop('id','especie_' + temp);
					}
				}
				contador--; //decrement textbox
		}
		return false;
	}

	function select_event(){
		$('.select-especie').change(function() {
		  	  var idselect = $(this).prop('id');
		      var id = $(this).val();
		      if(id!=0){
		        $('a#especie_'+idselect).attr("href", "ficha-especie.php?idEspecie="+id);
		        $('a#especie_'+idselect).fancybox();
		      }
		      else{
		        $('a#especie_'+idselect).attr("href", "#;");
		        $('a#especie_'+idselect).off();
		      }
		  });
	}

	$('.eliminar_ficha').click(del_event);
	select_event();

	$('#submit-reg-especie').click(function(){
		var datos ="";
		datos += "contador="+contador;
		datos += "&idregistro_buceo="+idregistro_buceo;
		for (var i = 1; i <= contador; i++) {
			datos += "&idespecie_"+ i + "=" + $('select#'+i).val();
		};

		$.ajax({
		url: 'addReg_especie.php',
		type: 'POST',
		async: true,
		data: datos,
		success: function(respuesta){
		  if(respuesta == "ok"){
		  	$('#form-especie :input').prop('disabled', true);
		    $('#reg-modal').modal();
		  }
		  else {
		     $('#reg-err-modal').modal();
		  }
		  }

		});
			
	});

	/* Mapa registro */
	var map_registro;
	var marker;
	function map_registro_init() {
		var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
		var mapOptions = {
			center: myLatLng,
			zoom: 5,
			mapTypeId: google.maps.MapTypeId.TERRAIN,
			streetViewControl: false
		};
		map_registro = new google.maps.Map(document.getElementById('map-canvas-registro'), mapOptions);

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
		});
	}
	/* Posiciona marcador al hacer doble click en mapa*/
	function placeMarker(position) {
		marker.setPosition(position);
		marker.setMap(map_registro);
		getPositionMarker(position);
	}
	/* Modifica input según movimiento del marcador en mapa */
	function getPositionMarker (position){
		document.getElementById('latitud').value = position.lat();
		document.getElementById('longitud').value = position.lng();
	}

	google.maps.event.addDomListener(window, 'load', map_registro_init);

	$('.position').change(function(){
		var lat = $('#latitud').val();
		var lng = $('#longitud').val();
		var myLatLng = new google.maps.LatLng(lat, lng);
		marker.setPosition(myLatLng);
	});

});
/* ./REGISTRO DE BUCEO */


/* BÚSQUEDA DE INFORMACIÓN */
$(document).ready(function() {

	/* Mapa búsqueda*/

	var map_busqueda;
	var rectangle_1;
	var rectangle_2;
	var infoWindow;
	var busqueda_ne_1;
	var busqueda_sw_1;
	var busqueda_ne_2;
	var busqueda_sw_2;
	var markers = [];

	function map_busqueda_init() {
		var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
		var mapOptions = {
			center: myLatLng,
			zoom: 5,
			mapTypeId: google.maps.MapTypeId.TERRAIN,
			streetViewControl: false
		};
		map_busqueda = new google.maps.Map(document.getElementById('map-canvas-busqueda'), mapOptions);
		
		// [START region_rectangle]
		var bounds = new google.maps.LatLngBounds(
		  new google.maps.LatLng(-38.302, -78.752),
		  new google.maps.LatLng(-33.992, -71.532)
		);

		// Define a rectangle and set its editable property to true.
		rectangle_1 = new google.maps.Rectangle({
			bounds: bounds,
			editable: true,
			draggable: true
		});

		rectangle_1.setMap(map_busqueda);

		bounds = new google.maps.LatLngBounds(
			new google.maps.LatLng(-33.192, -79.787),
			new google.maps.LatLng(-31.992, -69.587)
		);

		rectangle_2 = new google.maps.Rectangle({
			bounds: bounds,
			editable: true,
			draggable: true
		});

		rectangle_2.setMap(map_busqueda);

		infoWindow = new google.maps.InfoWindow();
		google.maps.event.addListener(rectangle_1, 'bounds_changed', showNewRect_1);
		google.maps.event.addListener(rectangle_2, 'bounds_changed', showNewRect_2);

		busqueda_ne_1 = rectangle_1.getBounds().getNorthEast();
		busqueda_sw_1 = rectangle_1.getBounds().getSouthWest();
	
		busqueda_ne_2 = rectangle_2.getBounds().getNorthEast();
		busqueda_sw_2 = rectangle_2.getBounds().getSouthWest();
		
	}
	
	
		
	function showNewRect_1(event) {
	busqueda_ne_1 = rectangle_1.getBounds().getNorthEast();
	busqueda_sw_1 = rectangle_1.getBounds().getSouthWest();
	
	}
	function showNewRect_2(event) {
	busqueda_ne_2 = rectangle_2.getBounds().getNorthEast();
	busqueda_sw_2 = rectangle_2.getBounds().getSouthWest();
	
	}
	
	google.maps.event.addDomListener(window, 'load', map_busqueda_init);

	$('#submit-busqueda-c').click(function(){
		for (x = markers.length-1;x>=0;x--){
			markers[x].setMap(null);
			markers.pop();
		}
		
		$.ajax({
			url: 'costa_getBusqueda-zona_copy.php',
			type: 'GET',
			async: true,
			data: {ne_lat: busqueda_ne_1.lat(), ne_lng: busqueda_ne_1.lng(), sw_lat: busqueda_sw_1.lat(), sw_lng: busqueda_sw_1.lng(),
					ne_lat2: busqueda_ne_2.lat(), ne_lng2: busqueda_ne_2.lng(), sw_lat2: busqueda_sw_2.lat(), sw_lng2: busqueda_sw_2.lng()},
			success: function(respuesta){/*
			  $.each(respuesta, function(i,item){
			    var myLatLng = new google.maps.LatLng(item.latitud, item.longitud);
			    var marker = new google.maps.Marker({
			      position: myLatLng,
			      title: item.idregistro_buceo,
			      map: map_busqueda
			    });
			    
			    var contentString = '<b>ID Buceo: '+ item.idregistro_buceo +'</b><br>' +
			        'Latitud: ' + item.latitud + '<br>' +
			        'Longitud: ' + item.longitud;
			    var infoWindow = new google.maps.InfoWindow();
			    // Set the info window's content and position.
			    infoWindow.setContent(contentString);
			    google.maps.event.addListener(marker, 'click', function() {
			      infoWindow.open(map_busqueda,marker);
			    });
			    rectangle_1.setDraggable(false);
			    rectangle_2.setDraggable(false);
			    markers[i] = marker;
			    x++;
			  });*/
			  alert(respuesta);
			},
			error: function(e){
			  alert("Error en la búsqueda");
			}
		});
	}); /*Submit Búsqueda*/

	$('#submit-nueva-busqueda-c').click(function(){
		rectangle_1.setDraggable(true);
		rectangle_2.setDraggable(true);
		for (x = markers.length-1;x>=0;x--){
			markers[x].setMap(null);
			markers.pop();
		}
	}); /*Submit Nueva Búsqueda*/

});
/* ./BÚSQUEDA DE INFORMACIÓN */

/* HISTORIAL DE REGISTROS */

$(document).ready(function(){

	$("#checkbox-all").click(function(){
		if($(this).is(':checked')) $('.cb').prop("checked",true);
		else $('.cb').prop("checked",false);
	});

	$('#delReg').click(function(){
		  var array_registros = new Array();
		  $('.cb').each(function(){if($(this).is(':checked')) { array_registros.push($(this).val());}});
		  if(array_registros.length > 0){
		    $.ajax({
		        url: 'costa_delRegistro.php',
		        type: 'POST',
		        async: true,
		        data: 'array_registros='+array_registros,
		        success: function(datos_recibidos) {
		        	$('#del-modal').modal();
		        	$.each( array_registros, function( i, val ) { $( "tr#" + val ).remove(); });
		        }
		    });
		 }
	});

});
/* ./HISTORIAL DE REGISTROS */

/* HOME */
$(document).ready(function(){
	$( "#btn-submit-registro" ).click(function() {
	  $( "#form-registro" ).submit();
	});

	$( "#nombre_usuario" ).change(function() {
		var nombre_usuario = $(this).val();
		$.ajax({
		        url: 'comprobar_nu.php',
		        type: 'GET',
		        async: true,
		        data: 'nombre_usuario='+ nombre_usuario,
		        success: function(respuesta) {
		        	if(respuesta == 1)
		        	{
		        		$('#div-nombre_usuario').removeClass("has-success");
		        		$('#div-nombre_usuario').addClass("has-error");
		        	}
		        	else
		        	{
		        		$('#div-nombre_usuario').removeClass("has-error");
		        		$('#div-nombre_usuario').addClass("has-success");
		        	}
		        }
		});
	});
});