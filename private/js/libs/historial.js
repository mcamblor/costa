(function(){
  'use strict';

  $.fn.Historial = function(){
    Notificaciones.init({"selector": ".bb-alert"});
    var mensajeError = "Error de conexión";
    var $badge = $('.badge');
    var btnsTpl = '<div class="btn-group">' +
                        '<button type="button" class="btn-ver btn btn-default" aria-label="Left Align">' +
                          '<span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span> Ver' +
                        '</button>' +
                        '<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">' +
                          '<span class="caret"></span>' +
                          '<span class="sr-only">Toggle Dropdown</span>' +
                        '</button>' +
                        '<ul class="dropdown-menu" role="menu">' +
                          '<li><a role="button" class="btn-editar" href="#;">' +
                                  '<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar' + 
                              '</a></li>' +
                          '<li><a role="button" class="btn-eliminar" href="#;">' + 
                                  '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar' + 
                              '</a></li>' +
                        '</ul>' +
                       '</div>'
    ;
    var dtOptions = 
        {
            ajax: "api/buceos.php?function=getHistorialByIdUsuario",
            language: {
                url: 'http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json'
            },
            rowCallback: function(row, data){
                var $row = $(row);
                $row.find('.btn-ver').unbind('click').on('click', btnVerEvento);
                $row.find('.btn-editar').unbind('click').on('click', btnEditarEvento);
                $row.find('.btn-eliminar').unbind('click').on('click', btnEliminarEvento);
            },
            drawCallback: function( settings ) {
                var api = this.api();
                $badge.text(api.data().length);
            },
            columns: [
                { 
                    data: 'latitud',
                    class: 'text-center',
                    title: 'Latitud'
                },
                {
                    data: 'longitud',
                    class: 'text-center',
                    title: 'Longitud'
                },
                {
                    data: 'fecha',
                    class: 'text-center',
                    title: 'Fecha'
                },
                {
                    data: 'tipo',
                    class: 'text-center',
                    title: 'Tipo'
                },
                {
                    data: 'temp_superficie',
                    class: 'text-center',
                    title: 'Temp. Superficie'
                },
                {
                    data: 'temp_fondo',
                    class: 'text-center',
                    title: 'Temp. Fondo'
                },
                {
                    data: 'tiempo',
                    class: 'text-center',
                    title: 'Tiempo'
                },
                {
                    data: 'profundidad_media',
                    class: 'text-center',
                    title: 'Prof. Media'
                },
                {
                    data: 'profundidad_maxima',
                    class: 'text-center',
                    title: 'Prof. Máxima'
                },
                {
                    data: 'visibilidad',
                    class: 'text-center',
                    title: 'Visibilidad'
                },
                {
                    data: 'corriente',
                    class: 'text-center',
                    title: 'Corriente'
                },
                {
                    defaultContent: btnsTpl
                }

            ]
        }
    ;

    function btnVerEvento(){}
    function btnEditarEvento(){}
    function btnEliminarEvento(){
      var fila = $(this).closest('tr')
        , data =  table.row(fila).data()
      ;

      bootbox.confirm( "Eliminar Buceo <span class='cap'><strong>" + data.id + "</strong></span>", function(result){
        if (result) {
            $.ajax({
                url: "/api/buceos.php"
              , data: {
                        "function" : "delete"
                      , "id" : data.id
                      }
              , type: "POST"
              , dataType : "json"
            })
            .done(function(data, textStatus, jqXHR){

                if(data.result)
                {
                    table
                      .row( fila )
                      .remove()
                      .draw();
                    Notificaciones.show("Buceo eliminado con éxito");
                }
                else Notificaciones.show("Lo sentimos, no se ha podido realizar la operación :(");

            })
            .fail(function(){
                Notificaciones.show(mensajeError);
            });
            // ./ ajax
        }
      });
    }

    var table = $("#tabla-historial").DataTable(dtOptions);
  }; // ./Historial
}());