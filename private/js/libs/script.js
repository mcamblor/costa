$(document).on("ready", function(){
    
    var path = window.location.pathname.substr(5).split(".")[0];
    switch(path) {
        case "busqueda":
            $.fn.Busqueda();
            break;
        case "mis-destinos/mapa":
            $.fn.MiMapa();
            break;
        case "mis-destinos/datos":
            $.fn.MisDatos();
            break;
    }
    
    $('#logout').on('click', function(){
        
        $.post('/api/sessions.php', {"function":"logout"}, function(data){
          localStorage.clear();
          location.href="/";
        }, 'json');
            
    });
  
    var usuario = JSON.parse(localStorage.getItem("usuario"));
    $('.nombre-usuario').text(usuario.nombre_usuario);

    $('#changepassword').on('click', function(){
      $.get('/app/cambio-contrasena.html', function(data){
        bootbox.dialog({
            title : 'Cambiar Contraseña'
          , message : data
          , buttons: {
              success: {   
                label: "Guardar cambios",
                className: "btn-success",
                callback: function() {
                  $.post('/api/usuarios.php', {
                    "function":"cambiarPassword"
                    , "currentPassword" : $("#currentPassword").val()
                    , "newPassword": $("#newPassword").val()
                  }, function(data){
                      if(data.valid) {
                        //Contraseña cambiada correctamente
                      }
                      else {
                        //Hubo un error al cambiar la contraseña
                      }
                  }, 'json');
                }
              },
              "Cancelar": {
                className: "btn-danger",
                callback: function() {}
              }
          }
        });
      });
    });
    
    $("#especie-autocomplete").autocomplete({
        minChars: 1,
        serviceUrl:'/api/especies.php?function=autocomplete',
        onSelect: function (suggestion) {
            $("#especie-autocomplete").val('');
            $.getJSON("/api/especies.php?function=getEspecieById",{"id":suggestion.data},function(data){
                var ficha = '<div class="panel panel-info">'+
                              '<div class="panel-heading"><h3 class="panel-title">Información Básica</h3></div>' +
                              '<div class="panel-body">' +
                                '<div class="col-md-6">'+
                                    '<p><b>Nombre Común: </b>' + data.nombre_comun +'</p>'  +
                                    '<p><b>Nombre Científico: </b>' + data.nombre_cientifico + '</p>' +
                                '</div>' +

                                '<div class="col-md-6">'+
                                    '<p><img class= "img-ficha" src="'+ ( data.ruta || "/img/especies/sin.jpg" )+'" title="'+ data.nombre_comun +'" alt="'+ data.nombre_comun +'" width="200" height="100"></p>'+
                                '</div>'+
                              '</div>'+
                            '</div>' +

                              '<div class="panel panel-info" align="justify">' +
                                '<div class="panel-heading"><h3 class="panel-title">Información Descriptiva</h3></div>' +
                                '<div class="panel-body">'+
                                  '<div class="col-md-4">'+
                                    '<h5><strong>Descripción</strong></h5><p>' + ( data.descripcion || "Sin Información" ) + '</p>' +
                                  '</div>' +
                                  '<div class="col-md-4">'+
                                    '<h5><strong>Distribución Geográfica</strong></h5><p>' + ( data.distribucion_geografica || "Sin Información" ) + '</p>' +
                                  '</div>' +
                                  '<div class="col-md-4">'+
                                    '<h5><strong>Ecología</strong></h5><p>' + ( data.ecologia || "Sin Información" ) + '</p>' +
                                  '</div>' +
                                '</div>' +
                              '</div>'
                ;
                bootbox.dialog({
                  message: ficha,
                  title: '<h3 class="modal-title panel-info">Ficha Especie</h3></div>'
                });
            });
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'No hay coincidencias'
    });
});