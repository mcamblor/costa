(function($){

    //Función serializa formularios a json
    $.fn.serializeObject = function()
    {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function() {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
}(jQuery));

$(document).on("ready", function(){
  
    
      
    
    /************************************/
    /** Ruteo **/
    var route = $('a.ruteo').Ruteo();
    if (window.location.hash === "" && history.state != null)
    {
        route.cambiar(history.state.substr(3) || "home");
    }
    else if (window.location.hash != "")
    {
        route.cambiar(window.location.hash.substr(2));
    }
    else route.cambiar("home");
    /*
    window.onpopstate = function(event) {
      route.cambiar(event.state.substr(1));
    };*/

    /************************************/
    /** Iniciar Sesión **/
    $('#login').on('submit', function(e){
        e.preventDefault();
        $.post('../api/sessions.php', $(this).serializeObject(), function(data){
            if ( data.session == "true" ){
                bootbox.alert("Bienvenido " + data.usuario.nombre_usuario);
                sessionStorage.setItem('session', data.session);
                sessionStorage.setItem('nombre_usuario', data.usuario.nombre_usuario);
                sessionStorage.setItem('email', data.usuario.email);
                $("div.logged").show();
                $("div.no-logged").hide();
            }
            else {
                bootbox.alert("Por favor, verifique los campos ingresados");
            }
        }, 'json');
    });
    
    /************************************/
    /** Cerrar Sesión **/
    
    $('#logout').on('click', function(){
        
        $.post('../api/sessions.php', {"function":"logout"}, function(data){
            if ( data.session == "false" ){
                bootbox.alert("Sesión cerrada");
                sessionStorage.clear();
                $("div.logged").hide();
                $("div.no-logged").show();
            }
        }, 'json');
            
    });
    
    /************************************/
    /** Control de Sesiones **/
    if ( sessionStorage.getItem('session') == "true" ){
        
        $("#nombre_usuario").text(sessionStorage.getItem('nombre_usuario'));
        $("div.logged").show();
        $("div.no-logged").hide();
        
    }
    else {
        $("div.logged").hide();
        $("div.no-logged").show();
    }
    
    /************************************/
    
    $("#especie-autocomplete").autocomplete({
        minChars: 1,
        serviceUrl:'api/especies.php?function=autocomplete',
        onSelect: function (suggestion) {
            $.getJSON("api/especies.php?function=getEspecieById",{"id":suggestion.data},function(data){
              
                var ficha = '<div class="row">'+

                              '<div class="col-md-8">'+
                                  '<p><b>Nombre Común</b></p>' +
                                  '<p><b>Nombre Científico</b></p>' +
                                  '<p><b>Kingdom</b></p>' +
                                  '<p><b>Phylum</b></p>' +
                                  '<p><b>Class</b></p>' +
                                  '<p><b>Order</b></p>' +
                                  '<p><b>Family</b></p>' +
                                  '<p><b>Genus</b></p>' +
                                  '<p><b>Aphia</b></p>' +
                              '</div>' +

                              '<div class="col-md-4">' +
                                  '<p>' + data.nombre_comun + '</p>' +
                                  '<p>' + data.nombre_cientifico + '</p>' +
                                  '<p>' + data.kingdom + '</p>' +
                                  '<p>' + data.phylum + '</p>' +
                                  '<p>' + data.class + '</p>' +
                                  '<p>' + data.order + '</p>' +
                                  '<p>' + data.family + '</p>' +
                                  '<p>' + data.genus + '</p>' +
                                  '<p>' + data.aphia + '</p>' +
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