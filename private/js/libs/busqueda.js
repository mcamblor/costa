(function(){
    'use strict';

    $.fn.Busqueda = function(){
      
      google.load("visualization", "1", {packages:["corechart"], callback: function() {}});
      google.setOnLoadCallback(drawChart);
      var chartBuceos;
      var cartDensidad;
      var datosGrafico;
      var datosDensidad;
      var options;
      function drawChart(tipo) {

          options = {
            title: 'Especies visualizadas',
            vAxis: {title: 'Especies',  titleTextStyle: {color: 'red'}}
          };

          chartBuceos = new google.visualization.BarChart(document.getElementById('chartVisualizaciones_div'));
          cartDensidad = new google.visualization.BarChart(document.getElementById('chartDensidad_div'));

          if(tipo = "buceos"){
              chartBuceos.draw(datosGrafico, options);
          }

          if(tipo = "densidad"){
            options = {
              title: 'Especies visualizadas',
              vAxis: {title: 'Especies',  titleTextStyle: {color: 'red'}},
              hAxis: { ticks: [{v:0, f:''},{v:1, f:'Único'}, {v:2, f:'Poco Abundante'}, {v:3, f:'Abundante'}, {v:4, f:'Muy Abundate'}] }
            };
             cartDensidad.draw(datosDensidad, options);
          }

      }

      var map;
      var markers = [];
      $('#btn-continuar').on('click',function(){
        var data = [];
        var id_buceos = [];
        $(markers).each(function(index, marker){
            if (marker.getVisible()) {
                data.push( marker.get('id') );
                id_buceos.push(marker.get('id'));
            }
        });

        var total = data.length;
        if ( data.length === 0 ) {
            bootbox.alert("No hay buceos dentro del área seleccionada");
            return false;
        }
        bootbox.dialog({
          message: '<div id="chartVisualizaciones_div" style="top: 10px; width: 750px; height: 400px;"></div>' +
                   '<div id="chartDensidad_div" style="top: 5px; width: 750px; height: 400px"></div>'
        });

        var array_densidad = [];
        $.getJSON("../api/buceo_especie.php?function=getEspeciesByIdBuceo", {buceos: data.toString()}, function(data)
        {                     
            var arreglo = [];
            arreglo.push(['Especie', 'Frecuencia']);
            $(data).each(function(index,element){
                arreglo.push([element.nombre_comun, element.count/total]);
                array_densidad.push(element.id);
            });

            datosGrafico = google.visualization.arrayToDataTable(arreglo);
            drawChart("buceos");
            $.getJSON("../api/buceo_especie.php?function=getDensidadByIdEspecie", {densidad: array_densidad.toString(), buceos: id_buceos.toString()}  , function(array_densidad,id_buceos)
            {
              var array_especies = [];
              array_especies.push(['Especie', 'Densidad']);
              $(array_densidad).each(function(index,element){
                  array_especies.push([element.nombre_comun, parseInt(element.abundancia)]);
              });
              datosDensidad = google.visualization.arrayToDataTable(array_especies);
              drawChart("densidad");
            });
        });
        
      });
      
      function map_init() {

          var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
          var mapOptions = {
              center: myLatLng,
              zoom: 5,
              mapTypeId: google.maps.MapTypeId.SATELLITE,
              disableDefaultUI: true,
              streetViewControl: false
          };
          map = new google.maps.Map(document.getElementById('map-busqueda'), mapOptions);

          var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.POLYGON,
            drawingControl: true,
            drawingControlOptions: {
              position: google.maps.ControlPosition.TOP_CENTER,
              drawingModes: [google.maps.drawing.OverlayType.POLYGON]
            },
            polygonOptions: {
              editable:true
            }
          });
          
          google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            var fechaIni = $("input[name='fechaInicio']").val();
            var fechaFin = $("input[name='fechaFin']").val();
              $(markers).each(function(index, marker){
                  if (google.maps.geometry.poly.containsLocation(marker.position, polygon)) {
                    if(fechaIni ==='' ||  fechaFin ===''){
                      marker.setVisible(true);
                    }else{
                        if(fechaIni < marker.fecha &&  fechaFin > marker.fecha){
                          marker.setVisible(true);
                        }else {
                          marker.setVisible(false);
                        }
                    }
                  } else {
                    marker.setVisible(false);
                  }
              });
              drawingManager.setOptions({
                drawingMode: null
              });

          });
          drawingManager.setMap(map);

          $.getJSON("../api/buceos.php?function=getBuceos", function(data){
              $(data).each(function(index, element){
                  var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(element.latitud, element.longitud),
                      map: map,
                      visible: false,
                      title:"Hello World!",
                      fecha: element.fecha,
                      icon: new google.maps.MarkerImage('../img/diving.png')
                  });
                  marker.set("id", element.id);
                  var infowindow = new google.maps.InfoWindow();    
                  google.maps.event.addListener(marker, 'click', function (target, elem) {

                      infowindow.setContent("Cargando...");
                      infowindow.open(map, marker);

                      $.getJSON("../api/buceos.php?function=getBuceoById",{"id": marker.get("id")}, function(data){
                        
                          var nombres = Object.keys(data);
                          for(var x = 0, len = nombres.length; x < len; ++x){
                              var nombre = nombres[x];
                              if (data[nombre] === null)
                                  data[nombre] = 'No registrado';
                          }
                        
                          var contentString = '<div id="content">'+

                                              '<div id="bodyContent">'+

                                              '<div class="panel panel-info">' +
                                              '<div class="panel-heading"><h4>Información de buceo</h4></div>'+
                                              '<div class="panel-body">' +

                                              '<div class="row">'+

                                              '<div class="col-md-8">'+
                                              '<p><b>Latitud</b></p>' +
                                              '<p><b>Longitud</b></p>' +
                                              '<p><b>Usuario</b></p>' +
                                              '<p><b>Fecha</b></p>' +
                                              '<p><b>Corriente</b></p>' +
                                              '<p><b>Profundidad máxima</b></p>' +
                                              '<p><b>Profundidad media</b></p>' +
                                              '<p><b>Temperatura fondo</b></p>' +
                                              '<p><b>Temperatura superficie</b></p>' +
                                              '<p><b>Tiempo</b></p>' +
                                              '<p><b>Tipo</b></p>' +
                                              '<p><b>Visibilidad</b></p>' +
                                              '</div>' +

                                              '<div class="col-md-4">' +
                                              '<p>' + data.latitud + '</p>' +
                                              '<p>' + data.longitud + '</p>' +
                                              '<p>' + data.nombre_usuario + '</p>' +
                                              '<p>' + data.fecha + '</p>' +
                                              '<p>' + data.corriente + '</p>' +
                                              '<p>' + data.profundidad_maxima + '</p>' +
                                              '<p>' + data.profundidad_media + '</p>' +
                                              '<p>' + data.temp_fondo + '</p>' +
                                              '<p>' + data.temp_superficie + '</p>' +
                                              '<p>' + data.tiempo + '</p>' +
                                              '<p>' + data.tipo + '</p>' +
                                              '<p>' + data.visibilidad + '</p>' +
                                              '</div>' +

                                              '</div>' +
                                              '</div>' +
                                              '</div>' +

                                              '</div>'+
                                              '</div>';

                          infowindow.setContent(contentString);
                      });

                  });

                  markers.push(marker);
              });
          });
      }

      //google.maps.event.addDomListener(window, 'load', map_init);
      map_init();
      
      return map;
    }; // ./SEARCH
}());