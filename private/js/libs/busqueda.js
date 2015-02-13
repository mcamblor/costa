(function(){
    'use strict';

    $.fn.Busqueda = function(){
      document.getElementById('fechaInicio').disabled = true;
      document.getElementById('fechaFin').disabled = true;
      document.getElementById('especie-busqueda-autocomplete').disabled = true;
      document.getElementById('region-busqueda-autocomplete').disabled = true;
      google.load("visualization", "1", {packages:["corechart"], callback: function() {}});
      google.setOnLoadCallback(drawChart);
      var chartBuceos;
      var cartDensidad;
      var datosGrafico;
      var datosDensidad;
      var options;
      function drawChart(tipo) {

          options = {
            height: 600,
            width: 700,
            title: 'Frecuencia de especies visualizadas',
            vAxis: { textStyle: {fontName: 'arial', fontSize: 10} },
            //chartArea: {left:100, width: 700} ,
            //vAxis: {textPosition : 'in',fontSize: 6,},
            hAxis: {textStyle: {fontName: 'arial', fontSize: 10}},
          };

          chartBuceos = new google.visualization.BarChart(document.getElementById('chartVisualizaciones_div'));
          cartDensidad = new google.visualization.BarChart(document.getElementById('chartDensidad_div'));

          if(tipo = "buceos"){
              chartBuceos.draw(datosGrafico, options);
          }

          if(tipo = "densidad"){
            options = {
              height: 600,
              width: 700,
              title: 'Densidad de especies visualizadas',
              vAxis: { textStyle: {fontName: 'arial', fontSize: 10} },
              //chartArea: {left:100, width: 700} ,
              //vAxis: {textPosition : 'in',fontSize: 6,},
              //vAxis: {title: 'Especies',  titleTextStyle: {color: 'red'}},
              hAxis: { ticks: [{v:0, f:''},{v:1, f:'Único'}, {v:2, f:'Poco Abundante'}, {v:3, f:'Abundante'}, {v:4, f:'Muy Abundate'}],textStyle: {fontName: 'arial', fontSize: 10} }
            };
             cartDensidad.draw(datosDensidad, options);
          }

      }
      //Completar regiones """Arreglar"""
      $.getJSON("api/regiones.php?function=get",function(data){
        var options = "";
        for (var i = 0, len = data.length; i<len; ++i){
          if (data[i].id != 15) {
            options +=  "<option value='" + data[i].id + "'>" + data[i].data + "</option>";
          };          
        }
        $("[name='region-busqueda-autocomplete']").html(options);
      });
    

      //switch para filtros
      $('.BSswitch').bootstrapSwitch('state', false);

      //Filtro de fecha
      $('input[name="filtro-fecha"]').on('switchChange.bootstrapSwitch', function(event, state) {
          if (state) {
            document.getElementById('fechaInicio').disabled = false;
            document.getElementById('fechaFin').disabled = false;
            document.getElementById('instruccion').innerHTML = "Con este filtro puedes seleccionar los buceos que se hayan realizado en ese rango de fechas.";
            //$('#filtro-especies').bootstrapSwitch('state',false);
          } else{
            document.getElementById('fechaInicio').disabled = true;
            document.getElementById('fechaFin').disabled = true;
            document.getElementById('instruccion').innerHTML = "<strong>Hola,</strong> para realizar una búsqueda, debes generar un polígono marcando los vértices en el mapa la posición que deseas. Además puedes seleccionar uno de los filtros para tu búsqueda.";
          };
      });

      $('input[name="filtro-especies"]').on('switchChange.bootstrapSwitch', function(event, state) {
          if (state) {
            document.getElementById('especie-busqueda-autocomplete').disabled = false;
             //$('#filtro-fechas').bootstrapSwitch('state',false);
             document.getElementById('instruccion').innerHTML = "Con este filtro puedes seleccionar los buceos que sólo hayan registrado la especie.";
          } else{
            document.getElementById('especie-busqueda-autocomplete').disabled = true;
            document.getElementById('instruccion').innerHTML = "<strong>Hola,</strong> para realizar una búsqueda, debes generar un polígono marcando los vértices en el mapa la posición que deseas. Además puedes seleccionar uno de los filtros para tu búsqueda.";
          };
      });

      $('input[name="filtro-region"]').on('switchChange.bootstrapSwitch', function(event, state) {
          if (state) {
            document.getElementById('region-busqueda-autocomplete').disabled = false;
             //$('#filtro-fechas').bootstrapSwitch('state',false);
             document.getElementById('instruccion').innerHTML = "Con este filtro puedes seleccionar los buceos que sólo se hayan registrado en la región.";
          } else{
            document.getElementById('region-busqueda-autocomplete').disabled = true;
            document.getElementById('instruccion').innerHTML = "<strong>Hola,</strong> para realizar una búsqueda, debes generar un polígono marcando los vértices en el mapa la posición que deseas. Además puedes seleccionar uno de los filtros para tu búsqueda.";
          };
      });



      var filtro_id = -1;
      var especie_name;
      //Autocomplete para filtro de registro
      $("#especie-busqueda-autocomplete").autocomplete({
        minChars: 1,
        serviceUrl:'api/especies.php?function=autocomplete',
        onSelect: function (suggestion) {
            //$("#especie-busqueda-autocomplete").val('');
            $.getJSON("api/especies.php?function=getEspecieById",{"id":suggestion.data},function(data){
              //alert("pruebas: "+data.nombre_comun);
              especie_name = data.nombre_comun;
              filtro_id = data.id;
            });
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'No hay coincidencias'
    });


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

        var especie_filtro = document.getElementById('especie-busqueda-autocomplete');
        var total = data.length;
        if ( data.length === 0 ) {
          if (especie_filtro.disabled) {
            bootbox.alert("No hay buceos dentro del área seleccionada");
          } else{
            bootbox.alert("No existen datos de "+ especie_name +" dentro del área seleccionada");
          };
          return false;
        }

        bootbox.dialog({
          message: '<ul class="nav nav-tabs" id="tabContent">'+
                      '<li role="presentation" class="active"><a href="#frecuencia"  data-toggle="tab">Frecuencia</a></li>'+
                      '<li role="presentation"><a href="#densidad"  data-toggle="tab">Densidad</a></li>'+
                    '</ul>'+
                    '<div class="tab-content">'+
                      '<div class="tab-pane active" id="frecuencia">' +
                        '<div id="chartVisualizaciones_div"></div> '+
                      '</div>'+
                      '<div class="tab-pane" id="densidad">'+
                        '<div id="chartDensidad_div"></div>'+
                      '</div>'+
                    '</div>',
          onEscape: function() {
            location.reload();
          },
        });

        var array_densidad = [];
        $.getJSON("../api/buceo_especie.php?function=getEspeciesByIdBuceo", {buceos: data.toString()}, function(data)
        {                     
            var arreglo = [];
            arreglo.push(['Especie', 'Frecuencia']);
            $(data).each(function(index,element){
              //Filtro datos para grafo frecuencia según especie
              if (filtro_id === -1 ) {
                arreglo.push([element.nombre_comun, element.count/total]);
                array_densidad.push(element.id);
              }else{
                if (element.id === filtro_id) {
                  arreglo.push([element.nombre_comun, element.count/total]);
                  array_densidad.push(element.id);
                };
              };
            });

            datosGrafico = google.visualization.arrayToDataTable(arreglo);
            drawChart("buceos");

            $.getJSON("../api/buceo_especie.php?function=getDensidadByIdEspecie", {densidad: array_densidad.toString(), buceos: id_buceos.toString()}  , function(array_densidad,id_buceos)
            {
              var array_especies = [];
              array_especies.push(['Especie', 'Densidad']);
              $(array_densidad).each(function(index,element){
                //Filtro datos para grafo densidad según especie
                if (filtro_id === -1) {
                    array_especies.push([element.nombre_comun, parseInt(element.abundancia)]);
                } else{
                  if (element.id_especie === filtro_id) {
                    array_especies.push([element.nombre_comun, parseInt(element.abundancia)]);
                  };
                };
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
              zoom: 4,
              mapTypeId: google.maps.MapTypeId.SATELLITE,
              disableDefaultUI: false,
              streetViewControl: false,
              scaleControl: true,
          };
          map = new google.maps.Map(document.getElementById('map-busqueda'), mapOptions);

          //map.data.loadGeoJson('http://costa-humboldt.com/js/region.json');

          var a = [
            new google.maps.LatLng(-32.18,-71.54),
            new google.maps.LatLng(-32.18,-100.77),
            new google.maps.LatLng(-33.90,-100.77),
            new google.maps.LatLng(-33.90,-71.83)
          ];
          //var reg = new google.maps.Polygon({paths: a});

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
            var especie = $('#especie-busqueda-autocomplete').val();
            var region = document.getElementById('region-busqueda-autocomplete').disabled;
            var num_reg = $('#region-busqueda-autocomplete').val();
              $(markers).each(function(index, marker){
                  if (google.maps.geometry.poly.containsLocation(marker.position, polygon)) {
                    //Filtro de fecha para mapa
                    if(fechaIni ==='' ||  fechaFin ===''){
                      if (especie === '') {
                        if ((!region) ) {
                          $.getJSON("../js/region.json", function(data){
                            for (var i = data.features.length - 1; i >= 0; i--) {
                              if (num_reg === data.features[i].properties.id) {
                                var  coordinates = data.features[i].geometry.coordinates;                                
                                var paths = [];
                                var ll;
                                $.each(coordinates,function(i,n){
                                  $.each(n, function(j,o){
                                    ll = new google.maps.LatLng(o[1],o[0]);
                                    paths.push(ll); 
                                  });
                                });
                                var polygon = new google.maps.Polygon({
                                    paths: paths,
                                    strokeColor: "#FF7800",
                                    strokeOpacity: 1,
                                    strokeWeight: 2,
                                    fillColor: "#46461F",
                                    fillOpacity: 0.25
                                });
                                polygon.setMap(map);

                                var reg = new google.maps.Polygon({paths: paths});
                                if(google.maps.geometry.poly.containsLocation(marker.position, reg)){
                                   marker.setVisible(true);
                                }
                              };
                            };
                          });
                        }else{
                          marker.setVisible(true);
                        };
                      } else{
                        //Filtro datos para mapa según especie
                        $.getJSON("../api/buceo_especie.php?function=getEspecieByIdBuceo",{"buceoId": marker.get("id")}, function(data){
                          $(data).each(function(index,element){
                            if (element.id === filtro_id) {
                              if ((!region) ) {
                                $.getJSON("../js/region.json", function(data){
                                  for (var i = data.features.length - 1; i >= 0; i--) {
                                    if (num_reg === data.features[i].properties.id) {
                                      var  coordinates = data.features[i].geometry.coordinates;                                
                                      var paths = [];
                                      var ll;
                                      $.each(coordinates,function(i,n){
                                        $.each(n, function(j,o){
                                          ll = new google.maps.LatLng(o[1],o[0]);
                                          paths.push(ll); 
                                        });
                                      });
                                      var polygon = new google.maps.Polygon({
                                          paths: paths,
                                          strokeColor: "#FF7800",
                                          strokeOpacity: 1,
                                          strokeWeight: 2,
                                          fillColor: "#46461F",
                                          fillOpacity: 0.25
                                      });
                                      polygon.setMap(map);

                                      var reg = new google.maps.Polygon({paths: paths});
                                      if(google.maps.geometry.poly.containsLocation(marker.position, reg)){
                                         marker.setVisible(true);
                                      }
                                    };
                                  };
                                });
                              }else{
                                marker.setVisible(true);
                              };
                            } 
                          });
                        });
                      };
                    }else{
                        if(fechaIni < marker.fecha &&  fechaFin > marker.fecha){
                          //marker.setVisible(true);
                          if (especie === '') {
                            if ((!region) ) {
                              $.getJSON("../js/region.json", function(data){
                                for (var i = data.features.length - 1; i >= 0; i--) {
                                  if (num_reg === data.features[i].properties.id) {
                                    var  coordinates = data.features[i].geometry.coordinates;                                
                                    var paths = [];
                                    var ll;
                                    $.each(coordinates,function(i,n){
                                      $.each(n, function(j,o){
                                        ll = new google.maps.LatLng(o[1],o[0]);
                                        paths.push(ll); 
                                      });
                                    });
                                    var polygon = new google.maps.Polygon({
                                        paths: paths,
                                        strokeColor: "#FF7800",
                                        strokeOpacity: 1,
                                        strokeWeight: 2,
                                        fillColor: "#46461F",
                                        fillOpacity: 0.25
                                    });
                                    polygon.setMap(map);

                                    var reg = new google.maps.Polygon({paths: paths});
                                    if(google.maps.geometry.poly.containsLocation(marker.position, reg)){
                                       marker.setVisible(true);
                                    }
                                  };
                                };
                              });
                            }else{
                              marker.setVisible(true);
                            };
                          } else{
                            //Filtro datos para mapa según especie
                            $.getJSON("../api/buceo_especie.php?function=getEspecieByIdBuceo",{"buceoId": marker.get("id")}, function(data){
                              $(data).each(function(index,element){
                                if (element.id === filtro_id) {
                                  if ((!region) ) {
                                    $.getJSON("../js/region.json", function(data){
                                      for (var i = data.features.length - 1; i >= 0; i--) {
                                        if (num_reg === data.features[i].properties.id) {
                                          var  coordinates = data.features[i].geometry.coordinates;                                
                                          var paths = [];
                                          var ll;
                                          $.each(coordinates,function(i,n){
                                            $.each(n, function(j,o){
                                              ll = new google.maps.LatLng(o[1],o[0]);
                                              paths.push(ll); 
                                            });
                                          });
                                          var polygon = new google.maps.Polygon({
                                              paths: paths,
                                              strokeColor: "#FF7800",
                                              strokeOpacity: 1,
                                              strokeWeight: 2,
                                              fillColor: "#46461F",
                                              fillOpacity: 0.25
                                          });
                                          polygon.setMap(map);

                                          var reg = new google.maps.Polygon({paths: paths});
                                          if(google.maps.geometry.poly.containsLocation(marker.position, reg)){
                                             marker.setVisible(true);
                                          }
                                        };
                                      };
                                    });
                                  }else{
                                    marker.setVisible(true);
                                  };
                                }
                              });
                            });
                          };
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
                      title:"Registro de Buceo N°: "+element.id,
                      fecha: element.fecha,
                      icon: new google.maps.MarkerImage('../img/diving.png')
                  });
                  marker.set("id", element.id);
                  var infowindow = new google.maps.InfoWindow();    
                  google.maps.event.addListener(marker, 'click', function (target, elem) {
                      infowindow.setContent("Cargando...");
                      infowindow.open(map, marker);
                      infowindow.maxWidth = 450;

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