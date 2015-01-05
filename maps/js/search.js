    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(drawChart);
    var chart;
    var datosGrafico;
    function drawChart() {

        var options = {
          title: 'Especies visualizadas',
          vAxis: {title: 'Especies',  titleTextStyle: {color: 'red'}}
        };

        chart = new google.visualization.BarChart(document.getElementById('chart_div'));

        chart.draw(datosGrafico, options);
    }


$(document).on('ready', function(){

    var map;
    var markers = [];
	function map_init() {
        
		var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
		var mapOptions = {
			center: myLatLng,
			zoom: 5,
			mapTypeId: google.maps.MapTypeId.SATELLITE,
			streetViewControl: false
		};
		map = new google.maps.Map(document.getElementById('map'), mapOptions);

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
            $(markers).each(function(index, marker){
                
                if (google.maps.geometry.poly.containsLocation(marker.position, polygon)) {
                    marker.setVisible(true);
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
                    icon: new google.maps.MarkerImage('../img/diving.png')
                });
                marker.set("id", element.id);
                var infowindow = new google.maps.InfoWindow();    
                google.maps.event.addListener(marker, 'click', function (target, elem) {
                
                    infowindow.setContent("Cargando...");
                    infowindow.open(map, marker);
                    
                    $.getJSON("../api/buceos.php?function=getBuceoById",{"id": marker.get("id")}, function(data){
                        var contentString = '<div id="content">'+
                            
                                            '<div id="bodyContent" style="width: 400px;">'+
                            
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

	google.maps.event.addDomListener(window, 'load', map_init);

  	$('#rootwizard').bootstrapWizard(
    {
        onTabClick: function(tab, navigation, index) {
            return false;
        },
        onNext: function(tab, navigation, index) {
            switch(index) {
                case 1:
                    console.log("Habemus paso 1");
                    var data = [];
                    $(markers).each(function(index, marker){
                        if (marker.getVisible()) {
                            data.push( marker.get('id') );
                        }
                    });
                    
                    var total = data.length;
                    
                    $.getJSON("../api/buceo_especie.php", {buceos: data.toString()}, function(data)
                    {
                        console.log(data);
                        
                        var arreglo = [];
                        arreglo.push(['Especie', 'Frecuencia', 'Densidad']);
                        $(data).each(function(index,element){
                            arreglo.push([element.id, element.count/total, 0]);
                        });
                        
                        datosGrafico = google.visualization.arrayToDataTable(arreglo);
                        drawChart();

                    });
                    break;
                case 2:
                    console.log("Habemus paso 2");
                    break;
            }
        }
    });
    
    /******** Graficos ***********/
    
    /********* Graficos ************/
});