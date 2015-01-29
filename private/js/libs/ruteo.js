(function(){
  function Ruteo($elemento, opciones){
    var self = this
      , rutas = []
      , $content
    ;
    self.$content = $content = $('.app-content');
    $elemento.on('click', function(e){
      e.preventDefault();
      var $this = $(this);
      self.cambiar($this.data('ruta'));
    });

  };

  Ruteo.prototype.constructor = Ruteo;
  Ruteo.prototype.destroy = function(){
  };
  Ruteo.prototype.cambiar = function(ruta){
    
    var self = this;
    
    $.get( "tpl/" + ruta + ".html", function(content){
      /* Modificar contenido contenedor */
      self.$content.html(content);
      /* Modificar ruta */
      history.pushState("/#/" + ruta, "tpl/" + ruta + ".html", "/#/" + ruta );
      /* Ejecutar Script */
      switch(ruta) {
          case '':
              $('a.ruteo').Ruteo();
              break;
          case 'busqueda':
              $('.app-content').Busqueda();
              break;
          case 'registro':
              $('.app-content').Registro();
              break;
          case 'historial':
              $('.app-content').Historial();
              break;
      }
      return true;
    }).fail(function(){
      return false;
    });
  };
  
  $.fn.Ruteo = function(){
    var $elemento = this;
    return new Ruteo($elemento, arguments[0]);
  };
}());
