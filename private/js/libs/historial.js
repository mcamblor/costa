(function(){
    'use strict';
    
    $.fn.Historial = function(){
        var nombre_usuario = sessionStorage.getItem('nombre_usuario');
        var dtOptions = 
            {
                ajax: "api/buceos.php?function=getHistorialByIdUsuario&nombre_usuario=" + nombre_usuario,
                language: {
                    url: 'http://cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Spanish.json'
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
                        data: 'localidad',
                        class: 'text-center',
                        title: 'Localidad'
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
                        title: 'Profundidad Media'
                    },
                    {
                        data: 'profundidad_maxima',
                        class: 'text-center',
                        title: 'Profundidad Máxima'
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
                    }
                ]
            }
        ;
        $("#tabla-historial").DataTable(dtOptions);
    }; // ./Historial
}());