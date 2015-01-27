var express = require('express')
var path = require('path')
var app = express()

app.use(express.static(path.join(__dirname, 'public') ));

var server = app.listen(process.env.OPENSHIFT_NODEJS_PORT || 5000, process.env.OPENSHIFT_NODEJS_IP || 'localhost', function (err) {
  if(err) console.log(err);

  var host = server.address().address
  var port = server.address().port

  console.log('Example app listening at http://%s:%s', host, port)

})