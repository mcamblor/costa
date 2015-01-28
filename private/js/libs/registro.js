(function(){
    'use strict';

    $.fn.Registro = function(){
      
        var validaciones = {}
          , map
          , marcador
        ;

        validaciones =
        {
            submitButtons: 'a.next',
            fields: {
              fecha: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Fecha es un campo obligatorio.'
                  }
                }
              },
              tipo: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Tipo es un campo obligatorio.'
                  }
                }
              },
              tiempo: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Tiempo es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Tiempo es un campo numérico'
                  }
                }
              },
              visibilidad: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Visibilidad es un campo obligatorio.'
                  }
                }
              },
              corriente: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Corriente es un campo obligatorio.'
                  }
                }
              },
              habitat: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Hábitat es un campo obligatorio.'
                  }
                }
              },
              temp_superficie: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Temperatura es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Temperatura es un campo numérico'
                  }
                }
              },
              temp_fondo: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Temperatura es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Temperatura es un campo numérico'
                  }
                }
              },
              prof_media: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Profundidad es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Profundidad es un campo numérico'
                  }
                }
              },
              prof_maxima: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Profundidad es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Profundidad es un campo numérico'
                  }
                }
              }
            }
        }; //./ Validaciones

        $('#rootwizard').bootstrapWizard(
        {
            onTabClick: function(tab, navigation, index) {
                return false;
            }
          , onNext: function(tab, navigation, index) {
                switch(index) {
                    case 1:
                        if (typeof marcador === "undefined") {
                            bootbox.alert("Debe seleccionar un punto en el mapa!");
                            return false;
                        }
                        else
                          $("form#buceo").bootstrapValidator(validaciones);
                        break;
                    case 2:
                        console.log("Habemus paso 2");
                        break;
                }
            }
        });
      
        function HomeControl(controlDiv, map) {

          // Set CSS styles for the DIV containing the control
          // Setting padding to 5 px will offset the control
          // from the edge of the map.
          controlDiv.style.padding = '5px';

          // Set CSS for the control border.
          var controlUI = document.createElement('div');
          controlUI.style.backgroundColor = 'white';
          controlUI.style.opacity = '0.7';
          controlUI.style.borderStyle = 'solid';
          controlUI.style.borderRadius = '5px';
          controlUI.style.borderWidth = '1px';
          controlUI.style.borderColor= 'white';
          controlUI.style.cursor = 'pointer';
          controlUI.style.textAlign = 'center';
          controlUI.title = 'Click to set the map to Home';
          controlDiv.appendChild(controlUI);

          // Set CSS for the control interior.
          var controlText = document.createElement('div');
          controlText.style.fontFamily = 'Arial,sans-serif';
          controlText.style.fontSize = '12px';
          //controlText.style.paddingLeft = '4px';
          //controlText.style.paddingRight = '4px';
          //controlText.innerHTML = '<strong>Agregar posición</strong>';
          controlText.innerHTML = '<input type="text" placeholder="Filtrar especie">';
          controlUI.appendChild(controlText);

          // Setup the click event listeners: simply set the map to Chicago.
          google.maps.event.addDomListener(controlUI, 'click', function() {
            map.setCenter(-60,-40)
          });
        }

        function map_init() {
            var myLatLng = new google.maps.LatLng(-36.7390, -71.05749);
            var mapOptions = {
                center: myLatLng,
                zoom: 5,
                mapTypeId: google.maps.MapTypeId.SATELLITE,
                disableDefaultUI: true,
                streetViewControl: false
            };
            map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var drawingManager = new google.maps.drawing.DrawingManager({
              drawingMode: google.maps.drawing.OverlayType.MARKER,
              drawingControl: true,
              drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [google.maps.drawing.OverlayType.MARKER]
              },
              markerOptions: {
                editable: true,
                crossOnDrag: true,
                draggable: true,
                icon: new google.maps.MarkerImage('img/diving.png')
              }
            });
            google.maps.event.addListener(drawingManager, 'markercomplete', function(marker) {
                $('#latitud').val(marker.position.lat());
                $('#longitud').val(marker.position.lng());
                marcador = marker;
                google.maps.event.addListener(marcador, 'drag', function() { this.setTitle(this.getPosition().toString()); } );
                this.setDrawingMode(null);
                this.setMap(null);
            });
          
            
            drawingManager.setMap(map);

            var homeControlDiv = document.createElement('div');
            var homeControl = new HomeControl(homeControlDiv, map);

            homeControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(homeControlDiv);
        }

        //google.maps.event.addDomListener(window, 'load', map_init);
        map_init();
      
        return map;
    }; // ./Registro
}());