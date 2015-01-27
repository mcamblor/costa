module.exports = function(coffee, less){
  return {
    js: [
        'private/js/vendor/jquery.min.js'
      , 'private/js/vendor/bootstrap.min.js'
      , 'private/js/vendor/bootbox.min.js'
      , 'private/js/vendor/bootstrapValidator.js'
      , 'private/js/vendor/jquery.autocomplete.js'
      , 'private/js/vendor/jquery.dataTables.min.js'
      , 'private/js/vendor/jquery.bootstrap.wizard.min.js'
      , 'private/js/vendor/mapsapi.min.js'
      , 'private/js/vendor/jsapi.min.js'
      , 'private/js/vendor/html5shiv.min.js'
      , 'private/js/vendor/respond.min.js'
      , 'private/js/libs/registro.js'
      , 'private/js/libs/busqueda.js'
      , 'private/js/libs/ruteo.js'
      , 'private/js/libs/script.js'
    ]
  , css: [
        'private/css/bootstrap.min.css'
      , 'private/css/bootstrap-theme.min.css'
      , 'private/css/bootstrapValidator.css'
      , 'private/css/jquery.dataTables.min.css'
      , 'private/css/style.css'
  ]
  , coffee: []
  , less: []
  };
}