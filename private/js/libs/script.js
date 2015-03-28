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
                                  '<p><b>Distribución Geográfica: </b></p>' +
                                  '<p><b>Descripción: </b></p>' +
                                  '<p><b>Ecología: </b></p>' +
                              '</div>' +

                              '<div class="col-md-8">' +
                                  '<p>' + data.nombre_comun + '</p>' +
                                  '<p>' + data.nombre_cientifico + '</p>' +
                                  '<p>' + data.distribucion_geografica + '</p>' +
                                  '<p>' + data.descripcion + '</p>' +
                                  '<p>' + data.ecologia + '</p>' +
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