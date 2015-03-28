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
                              '<div class="col-md-6 ficha-nombre">'+
                                  '<p><b>Nombre Común: </b>' + data.nombre_comun +'</p>'  +
                                  '<p><b>Nombre Científico: </b>' + data.nombre_cientifico + '</p>' +
                              '</div>' +

                              '<div class="col.md-6 ficha">'+
                                  '<p><img class= "img-ficha" src="'+ ( data.ruta || "/img/especies/sin.jpg" )+'" title="'+ data.nombre_comun +'" alt="'+ data.nombre_comun +'" width="200" height="100"></p>'+
                              '</div>'+

                              '<div class="col-md-12 ficha" align="justify">' +
                                '<div class="col-md-4">'+
                                  '<p><b><u>Descripción:</u> </b><br/><br/>' + ( data.descripcion || "Sin Información" ) + '</p>' +
                                '</div>' +
                                '<div class="col-md-4">'+
                                  '<p><b><u>Distribución Geográfica:</u> </b><br/><br/>' + ( data.distribucion_geografica || "Sin Información" ) + '</p>' +
                                '</div>' +
                                '<div class="col-md-4">'+
                                  '<p><b><u>Ecología:</u> </b><br/><br/>' + ( data.ecologia || "Sin Información" ) + '</p>' +
                                '</div>' +
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