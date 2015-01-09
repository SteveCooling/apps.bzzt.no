#!/usr/bin/node

var zmq = require('zmq')
  , sock = zmq.socket('push');

sock.connect('tcp://127.0.0.1:31336');
console.log('ServerTime connected to queue.');

setInterval(function(){
  var d = new Date();
  console.log('sending '+d.toJSON());
  sock.send(['timeserver', d.toJSON()]);
  //sock.send(['progress', d.getSeconds()]);
}, 1000);

