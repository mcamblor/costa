(function(){
    'use strict';

    $.fn.Inicio = function(){
      
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
                      message: 'Ya existe un personal con el rut ingresado',
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
      
        $('.registrate').on('click', function(){
          $.get('tpl/modalRegistro.html', function(html){
              var dialog = bootbox.dialog(
                  {
                  title: "Nuevo Usuario",
                  message: html
                  }
              );
              $('#nuevo-usuario')
              .bootstrapValidator(validaciones)
              .on('success.form.bv', function(e) {
                  e.preventDefault();
                  var $form = $(e.target);
                  var bv = $form.data('bootstrapValidator');
                  $.post( "api/usuarios.php", { function: "nuevoUsuario", usuario: JSON.stringify($form.serializeObject()) }, function( data ) {
                    if (data.valid)
                    {
                        dialog.modal('hide');
                        bootbox.alert("Usuario creado con éxito, bienvenido!");
                    }
                    else
                    {
                        dialog.modal('hide');
                        bootbox.alert("Ha ocurrido un inconveniente en la operación");
                    }
                  }, "json"); 
              });
          });
        });
      
    }; // ./Inicio
}());