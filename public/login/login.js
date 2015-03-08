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

$(document).ready(function(){
  if(!localStorage.getItem("usuario")){
    Notificaciones.init({"selector": ".bb-alert"});
    $('body').css('background','url(img/bg_images/fondo_' + Math.ceil( Math.random() * 6 ) +'.jpg) no-repeat center center fixed');
    $("#form-login").submit(function( event ){
        event.preventDefault();
        var login = $(this).serializeObject();
        $.extend(login, {function: "login"});
        $.ajax({
            type: "POST",
            url: "/api/sessions.php",
            data: login,
            dataType: "json"
        })
        .done(function( data ) {
          if(data.session == "true"){
            localStorage.setItem("usuario", JSON.stringify(data.usuarios));
            location.href = "app/mis-destinos/mapa.php";
          }
          else{
            Notificaciones.show("Usuario o contraseña incorrecta.");
          }
        })
        .fail(function( jqXHR, textStatus, errorThrown ){
          Notificaciones.show("Algo no está bien, inténtalo nuevamente.");
        });

    });
    var validaciones = 
    {
      fields: {
          nombre_usuario: {
            trigger:'blur',
            validators: {
              notEmpty: {
                message: 'Nombre Usuario es un campo obligatorio.'
              },
              remote: {
                  message: 'Ya existe un personal con el nombre ingresado',
                  url: 'api/usuarios.php?function=comprobarNombreUsuario',
                  data: {
                      type: 'nombre_usuario'
                  }
              }
            }
          },
          email: {
            trigger:'blur',
            validators: {
              notEmpty: {
                message: 'Correo es un campo obligatorio.'
              },
              remote: {
                  message: 'Ya existe un personal con el correo electrónico ingresado',
                  url: 'api/usuarios.php?function=comprobarEmail',
                  data: {
                      type: 'email'
                  }
              },
              emailAddress: {
                  message: 'Ingrese un correo válido'
              }
            }
          },
          nombre: {
            trigger:'blur',
            validators: {
              notEmpty: {
                message: 'Nombre es un campo obligatorio.'
              }
            }
          },
          apellido_pat: {
            trigger:'blur',
            validators: {
              notEmpty: {
                message: 'Apellido Paterno es un campo obligatorio.'
              }
            }
          },
          apellido_mat: {
            trigger:'blur',
            validators: {
              notEmpty: {
                message: 'Apellido Materno es un campo obligatorio.'
              }
            }
          },
          pass: {
            trigger:'blur',
            validators: {
              notEmpty: {
                message: 'Contraseña es un campo obligatorio.'
              }
            }
          }
      }
    };

    function completarSelect(campo){
        $.getJSON("/api/"+campo+".php?function=get",function(data){
            var options = "";
            for (var i = 0, len = data.length; i<len; ++i){
                options +=  "<option value='" + data[i].id + "'>" + data[i].data + "</option>";
            }
            $("[name='"+campo+"']").html(options);
        });
    }

    completarSelect("regiones");
    completarSelect("centro_buceo");
    $('#nuevo-usuario')
    .bootstrapValidator(validaciones)
    .on('success.form.bv', function(e) {
        e.preventDefault();
        var $form = $(e.target);
        var bv = $form.data('bootstrapValidator');
        $.post( "api/usuarios.php", { function: "nuevoUsuario", usuario: JSON.stringify($form.serializeObject()) }, function( data ) {
          if (data.valid)
          {
              $('#myModal').modal('hide');
              Notificaciones.show("Usuario creado con éxito, bienvenido!");
          }
          else
          {
              $('#myModal').modal('hide');
              Notificaciones.show("Ha ocurrido un inconveniente en la operación");
          }
        }, "json"); 
    });
  }
  else 
    location.href="/app/mis-destinos/mapa.php";
});