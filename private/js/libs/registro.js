(function(){
    'use strict';

    $.fn.Registro = function(){
      
        var validaciones = {}
          , map
          , marcador
        ;

        validaciones =
        {
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
                    message: 'Temperatura de superficie es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Temperatura de superficie es un campo numérico'
                  }
                }
              },
              temp_fondo: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Temperatura de fondo es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Temperatura de fondo es un campo numérico'
                  }
                }
              },
              prof_media: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Profundidad Media es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Profundidad Media es un campo numérico'
                  }
                }
              },
              prof_maxima: {
                trigger:'blur',
                validators: {
                  notEmpty: {
                    message: 'Profundidad Máxima es un campo obligatorio.'
                  },
                  numeric: {
                    message: 'Profundidad Máxima es un campo numérico'
                  }
                }
              }
            }
        }; //./ Validaciones
      
        var $sidebar = $('#sidebar')
          , $latitud = $('#latitud')
          , $longitud = $('#longitud')
          , $btnContinuar = $('#btn-continuar')
          , $instruccion = $('#instruccion')
          , $formBuceos
        ;

        $btnContinuar.on('click',function(){
            $sidebar.fadeOut();
            $instruccion.fadeOut();
            $.get('tpl/registro-buceo.html', function(data){
                var dialog = bootbox.dialog({
                    title: "Nuevo Buceo",
                    message: data
                });
                $formBuceos = $('form#buceos');
                completarSelect('habitat');
                $formBuceos.bootstrapValidator(validaciones)              
                .on('success.form.bv', function(e) {
                    e.preventDefault();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    var formObject = $form.serializeObject();
                    formObject.latitud = $latitud.text();
                    formObject.longitud = $longitud.text();
                    $.post( "api/buceos.php", { function: "post", buceo: JSON.stringify(formObject) }, function( data ) {
                        if (data.valid)
                        {
                            $('#contenido').load("tpl/registro-especies.html", registrarEspecies);
                        }
                        else
                        {
                            dialog.modal('hide');
                            bootbox.alert("No se ha podido realizar la operación");
                        }
                    }, "json"); 
              });
            });
        });
      
        function completarSelect(campo){
            $.getJSON("api/"+campo+".php?function=get",function(data){
                var options = "";
                for (var i = 0, len = data.length; i<len; ++i){
                    options +=  "<option value='" + data[i].id + "'>" + data[i].data + "</option>";
                }
                $("[name='"+campo+"']").html(options);
            });
        }
      
        function registrarEspecies(){
            var $repeat = $('.repeat')
              , $item = $repeat.find('.item')
              , $remover = $item.find('.remover')
              , $abunpres = $item.find('[name="presencia_ausencia"]')
              , $abundancia = $item.find('[name="abundancia"]')
              , $especie = $item.find('[name="especie"]')
              , $agregar = $('.agregar')
            ;
          
            $.getJSON("api/especies.php?function=get",function(data){
                var options = "";
                for (var i = 0, len = data.length; i<len; ++i){
                    options +=  "<option value='" + data[i].id + "'>" + data[i].nombre_comun + "</option>";
                }
                $("[name='especie']").html(options);
            });
            
            $abunpres.on('change',function(){
                if( $(this).val() === "0" )
                    $(this).closest(".item").find('[name="abundancia"]').prop('disabled', false);
                else
                    $(this).closest(".item").find('[name="abundancia"]').prop('disabled', true);
            });
            $remover.on('click', function(){
                $(this).closest(".item").remove();
            });
            $agregar.on('click', function(){
                $repeat.append($item.clone(true));
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
              drawingControl: false,
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
                $instruccion.html("<strong>Muy bien,</strong> también puedes arrastrar la marca en caso de que haya sido insertada en la posición incorrecta.");
                $latitud.text(marker.position.lat());
                $longitud.text(marker.position.lng());
                $sidebar.fadeIn();
                marcador = marker;
                google.maps.event.addListener(marcador, 'drag', function() { 
                    $latitud.text(this.position.lat());
                    $longitud.text(this.position.lng());
                });
                this.setDrawingMode(null);
                this.setMap(null);
            });
          
            
            drawingManager.setMap(map);

        }

        //google.maps.event.addDomListener(window, 'load', map_init);
        map_init();
      
        return map;
    }; // ./Registro
}());