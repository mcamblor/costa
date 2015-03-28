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
    
    $("#especie-autocomplete").autocomplete({
        minChars: 1,
        serviceUrl:'/api/especies.php?function=autocomplete',
        onSelect: function (suggestion) {
            $("#especie-autocomplete").val('');
            $.getJSON("/api/especies.php?function=getEspecieById",{"id":suggestion.data},function(data){
                var ficha = '<div class="row">'+
                              '<p><img src="'+data.ruta+'" title="'+ data.nombre_comun +'" alt="'+ data.nombre_comun +'" width="200" height="100"></p>'+
                              '<div class="col-md-4">'+
                                  '<p><b>Nombre Común: </b></p>'  +
                                  '<p><b>Nombre Científico: </b></p>' +
                                  '<p><b>Kingdom: </b></p>'+
                                  '<p><b>Phylum: </b></p>'+
                                  '<p><b>Class: </b></p>' +
                                  '<p><b>Order: </b></p>'  +
                                  '<p><b>Family: </b></p>'  +
                                  '<p><b>Genus: </b></p>'+
                                  '<p><b>Aphia: </b></p>' +
                                  '<p><b>Distribución Geográfica: </b></p>' +
                                  '<p><b>Descripción: </b></p>' +
                                  '<p><b>Ecología: </b></p>' +
                                  '<p><b>Importancia Económica: </b></p>'  +
                                  '<p><b>Biología Reproductiva: </b></p>'  +
                                  '<p><b>Referencias: </b></p>' +
                              '</div>' +

                              '<div class="col-md-8">' +
                                  '<p>' + data.nombre_comun + '</p>' +
                                  '<p>' + data.nombre_cientifico + '</p>' +
                                  '<p>' + data.kingdom + '</p>' +
                                  '<p>' + data.phylum + '</p>' +
                                  '<p>' + data.class + '</p>' +
                                  '<p>' + data.order + '</p>' +
                                  '<p>' + data.family + '</p>' +
                                  '<p>' + data.genus + '</p>' +
                                  '<p>' + data.aphia + '</p>' +
                                  '<p>' + data.distribucion_geografica + '</p>' +
                                  '<p>' + data.descripcion + '</p>' +
                                  '<p>' + data.ecologia + '</p>' +
                                  '<p>' + data.importancia_economica + '</p>' +
                                  '<p>' + data.biologia_reproductiva + '</p>' +
                                  '<p>' + data.referencias + '</p>' +
                              '</div>' +

                            '</div>';
                bootbox.dialog({
                  message: ficha,
                  title: "Ficha Especie"
                });
            });
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'No hay coincidencias'
    });
});