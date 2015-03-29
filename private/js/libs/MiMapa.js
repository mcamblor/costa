(function(){
    'use strict';

    $.fn.MiMapa = function(){
      
        var validaciones = {}
          , map
          , marcador
          , marcadores = []
          , drawingManager
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
              }
            }
        }; //./ Validaciones
      
        var $sidebar = $('#sidebar')
          , $latitud = $('#latitud')
          , $longitud = $('#longitud')
          , $btnContinuar = $('#btn-continuar')
          , $instruccion = $('#instruccion')
          , $btnNew = $('.btn-new')
          , $btnEdit = $('.btn-edit')
          , $formBuceos
          , funcion = 'new'
          , idBuceo
        ;
        var dialog;
      
        $btnEdit.on('click', function(){
            $btnNew.removeClass('active');
            $btnEdit.addClass('active');
            funcion = 'edit';
            for(var i = 0, len = marcadores.length; i < len; ++i){
                marcadores[i].setDraggable(true);
            }
            drawingManager.setDrawingMode(null);
            drawingManager.setMap(null);
            marcador.setMap(null);
        });
        $btnNew.on('click', function(){
            $btnEdit.removeClass('active');
            $btnNew.addClass('active');
            funcion = 'new';

            for(var i = 0, len = marcadores.length; i < len; ++i){
                marcadores[i].setDraggable(false);
            }
            drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
            drawingManager.setMap(map);
        });
        
        $btnContinuar.on('click',function(){
            $instruccion.fadeOut();
            $.get('/app/registro-buceo.html', function(data){
                  dialog = bootbox.dialog({
                    title: "Nuevo Buceo",
                    message: data,
                    className: "modalbuceo"
                }).on('shown.bs.modal', function(){
                  $('[data-toggle="popover"]').popover();
                  $('.bootbox').removeAttr('tabindex');
                  completarSelect('habitat');
                });
                $formBuceos = $('form#buceos');
                
                $formBuceos.bootstrapValidator(validaciones)              
                .on('success.form.bv', function(e) {
                    e.preventDefault();
                    var $form = $(e.target);
                    var bv = $form.data('bootstrapValidator');
                    var formObject = $form.serializeObject();
                    formObject.latitud = $latitud.text();
                    formObject.longitud = $longitud.text();
                    $.post( "/api/buceos.php", { function: "post", buceo: JSON.stringify(formObject) }, function( data ) {
                        if (data.valid)
                        {
                            idBuceo = data.id;
                            $('#contenido').load("/app/registro-especies.html", registrarEspecies);
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
            $.getJSON("/api/"+campo+".php?function=get",function(data){
                var options = "";
                for (var i = 0, len = data.length; i<len; ++i){
                    options +=  "<option value='" + data[i].id + "'>" + data[i].data + "</option>";
                }
                $("[name='"+campo+"']").html(options);
                $("select").select2();
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
          
            $.getJSON("/api/especies.php?function=get",function(data){
                var options = "";
                for (var i = 0, len = data.length; i<len; ++i){
                    options +=  "<option value='" + data[i].id + "'>" + data[i].nombre_comun + " - " + data[i].nombre_cientifico + "</option>";
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
          
          
            $('#postBuceoEspecies').on('submit', function(e){
                e.preventDefault();
                var formObject = $(this).serializeObject();
                var x = formObject;
                var objeto =[];
                var j = 0;
                for(var i = 0, len = x.especie.length; i<len; ++i )
                {
                    var ob ={};
                    ob.especie =x.especie[i];
                    if(x.presencia_ausencia[i] ==0){
                        ob.presente =1;
                        ob.abundancia = x.abundancia[j];
                        j++;
                      }
                    else{
                      ob.presente = 0;
                      ob.abundancia='NULL'
                    } 
                    objeto.push(ob);
                }
                $.post("/api/buceo_especie.php", {function: "postBuceoEspecie", buceo: idBuceo, especies: JSON.stringify(objeto)}, function(data){
                    dialog.modal('hide');
                    if (data.valid)
                    {
                        bootbox.alert("Buceo agregado con éxito");
                    }
                    else
                    {
                        bootbox.alert("No se ha podido realizar la operación");
                    }
                }, "json");
                
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

              drawingManager = new google.maps.drawing.DrawingManager({
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
                icon: new google.maps.MarkerImage('/img/new.png')
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
          
            getMyData();

        }
      
        function getMyData(){
          var buceo;
          $.getJSON('/api/buceos.php', { 'function' : 'getMyBuceos' }, function(data){
            data = data.data;
            for (var i = 0, len = data.length; i < len; ++i){
                buceo = data[i];

                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(buceo.latitud,buceo.longitud),
                    animation: google.maps.Animation.DROP,
                    map: map,
                    dataBuceo: buceo,
                    title: 'titulo',
                    icon: new google.maps.MarkerImage('/img/diving.png')
                });
                google.maps.event.addListener(marker, 'click', markerClickEvent);
                google.maps.event.addListener(marker, 'drag', markerDragEvent);
                marcadores.push(marker);
            }
          });
        }
      
        function markerDragEvent(e) {
          if (funcion == "new"){
            $latitud.text(this.position.lat());
            $longitud.text(this.position.lng());
          }
          else if (funcion == "edit"){
            $latitud.text(this.position.lat());
            $longitud.text(this.position.lng());
          }
        }
        function markerClickEvent(e){
          
          var buceo = this.dataBuceo;
          $.get('/app/registro-buceo.html', function(data){
              dialog = bootbox.dialog({
                title: "Editar Buceo",
                message: data,
                className: "modalbuceo"
              }).on('shown.bs.modal', function(){
                $('[data-toggle="popover"]').popover();
                $('.bootbox').removeAttr('tabindex');
              });
              
              $formBuceos = $('form#buceos');
              completarSelect('habitat');
              completarFormulario(buceo);
              $formBuceos.bootstrapValidator(validaciones)              
              .on('success.form.bv', function(e) {
                  e.preventDefault();
                  var $form = $(e.target);
                  var bv = $form.data('bootstrapValidator');
                  var formObject = $form.serializeObject();
                  formObject.latitud = $latitud.text();
                  formObject.longitud = $longitud.text();
                  $.post( "/api/buceos.php", { function: "put", buceo: JSON.stringify(formObject) }, function( data ) {
                      if (data.valid)
                      {
                          idBuceo = data.id;
                          $('#contenido').load("/app/registro-especies.html", registrarEspecies);
                      }
                      else
                      {
                          dialog.modal('hide');
                          bootbox.alert("No se ha podido realizar la operación");
                      }
                  }, "json"); 
              });
          });
        }
      
        function completarFormulario( buceo ){
          var $form = $('form#buceos');
          $form.find('[name="fecha"]').val(buceo.fecha);
          $form.find('[name="tipo"]').val(buceo.tipoE);
          $form.find('[name="tiempo"]').val(buceo.tiempo);
          $form.find('[name="visibilidad"]').val(buceo.visibilidadE);
          $form.find('[name="corriente"]').val(buceo.corrienteE);
          $form.find('[name="habitat"]').val("");
          $form.find('[name="temp_superficie"]').val(buceo.temp_superficie);
          $form.find('[name="temp_fondo"]').val(buceo.temp_fondo);
          $form.find('[name="prof_media"]').val(buceo.profundidad_media);
          $form.find('[name="prof_maxima"]').val(buceo.profundidad_maxima);
        }

        //google.maps.event.addDomListener(window, 'load', map_init);
        map_init();
      
        return map;
    }; // ./MiMapa
}());