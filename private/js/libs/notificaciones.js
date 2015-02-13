var Notificaciones = (function() {

  var elem,
      hideHandler,
      that = {};

  that.init = function(options) {
      elem = $(options.selector);
  };

  that.show = function(text) {
      clearTimeout(hideHandler);

      elem.find("span").html(text);
      elem.delay(100).fadeIn().delay(3000).fadeOut();
  };

  return that;
}());