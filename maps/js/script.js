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

$(document).on("ready", function(){

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
        serviceUrl:'../api/especies.php?function=autocomplete',
        onSelect: function (suggestion) {
            console.log("onSelect");
            $.getJSON("../api/especies.php?function=getEspecieById",{"id":suggestion.data},function(data){
                debugger;
                bootbox.alert("Modal para ficha con id : " + suggestion.data + "\n" + JSON.stringify(data));
            });
        },
        showNoSuggestionNotice: true,
        noSuggestionNotice: 'No hay coincidencias'
    });

});