(function(){
  'use strict';

  $.fn.MisDatos = function(){
    Notificaciones.init({"selector": ".bb-alert"});
    var mensajeError = "Error de conexión";
    var $badge = $('.badge')
      , $btnRefresh = $('.btn-refresh')
      , $btnNew = $('.btn-new');
    var btnsTpl = '<div class="btn-group">' +
                        '<button type="button" class="btn-eliminar btn btn-default" aria-label="Left Align">' +
                          '<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar' +
                        '</button>' +
                  '</div>'
    ;
    /*var btnsTpl = '<div class="btn-group">' +
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
    */
    var dtOptions = 
        {
            ajax: "/api/buceos.php?function=getMyBuceos",
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
    $btnRefresh.on('click', function(){
      table.ajax.reload();
    });
    $btnNew.on('click', function(){
      bootbox.dialog({
        title: 'Nuevo Buceo',
        message: 'Nuevo Buceo'
      });
    });
    function btnVerEvento(){}
    function btnEditarEvento(){}
    function btnEliminarEvento(){
      var fila = $(this).closest('tr')
        , data =  table.row(fila).data()
        , buceo = 
                              '<div class="col-md-4">'+
                                '<p> <strong>Latitud</strong>: </p>' +
                                '<p> <strong>Longitud</strong>: </p>' +
                                '<p> <strong>Fecha</strong>: </p>' + 
                                '<p> <strong>Tipo</strong>: </p>' +
                                '<p> <strong>Ttemperatura Superficie</strong>: </p>' +
                                '<p> <strong>Temperatura Fondo</strong>: </p>' +
                                '<p> <strong>Tiempo</strong>: </p>' +
                                '<p> <strong>Profundidad Media</strong>: </p>' +
                                '<p> <strong>Profundidad Máxima</strong>: </p>' +
                                '<p> <strong>Visibilidad</strong>: </p>' +
                                '<p> <strong>Corriente</strong>: </p>' +
                              '</div>' +

                              '<div class="col-md-8">' +
                                  '<p>' + data.latitud + '</p>' +
                                  '<p>' + data.fecha + '</p>' +
                                  '<p>' + data.tipo + '</p>' + 
                                  '<p>' + data.temp_superficie + '</p>' + 
                                  '<p>' + data.temp_fondo + '</p>' + 
                                  '<p>' + data.tiempo + '</p>' + 
                                  '<p>' + data.profundidad_media + '</p>' + 
                                  '<p>' + data.profundidad_maxima + '</p>' + 
                                  '<p>' + data.visibilidad + '</p>' + 
                                  '<p>' + data.corriente + '</p>' +
                              '</div>'
      ;
      bootbox.dialog({
        message: "<p>Está a punto de eliminar el buceo con los siguientes datos:</p> <span class='cap'>" + buceo + "</span>",
        title: "Confirmar Eliminación",
        buttons: {
          success: {
            label: "Si, deseo eliminarlo",
            className: "btn-success",
            callback: function() {
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
            }
          },
          danger: {
            label: "No, volver",
            className: "btn-danger",
            callback: function() {
              Notificaciones.show("El buceo no se ha eliminado");
            }
          }
        }
      });
    }

    var table = $("#tabla-historial").DataTable(dtOptions);
  }; // ./Historial
}());