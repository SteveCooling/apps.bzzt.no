#!/usr/bin/node

var ws = require("nodejs-websocket")
var zmq = require('zmq')

var pub = zmq.socket('pub');
pub.bind('tcp://127.0.0.1:31337');

var rep = zmq.socket('pull');
rep.bind('tcp://127.0.0.1:31336');

// Publish requests on pub/sub
rep.on('message', function(topic, message) {
	console.log(topic.toString());
	console.log(message.toString());
	var out = JSON.stringify({ type: topic.toString(), data: message.toString() });
	console.log('req => pub: '+out);
	pub.send([topic, message]);
	rep.send([topic, message]);
});

var server = ws.createServer(function (conn) {
    console.log("New connection")
    var sock = zmq.socket('sub');
    sock.connect('tcp://127.0.0.1:31337'); //'ipc:///tmp/zmqtest');
    //sock.connect('ipc:///tmp/zmqprogress');
    console.log('WebSocketServer bound to ipc:/tmp/zmqtest');
    sock.subscribe('');

    conn.on("text", function (str) {
        console.log("Received "+str)
		var recv = JSON.parse(str);
	
		switch(recv.type) {
		    case 'subscribe':
        		sock.subscribe(recv.data);
		        break;
		    case 'unsubscribe':
        		sock.unsubscribe(recv.data);
		        break;
		    default:
		        //default code block
		}
    })
    conn.on("close", function (code, reason) {
        console.log("Connection closed");
	sock.close();
    })

    sock.on('message', function(topic, message) {
	var out = JSON.stringify({ type: topic.toString(), data: message.toString() });
	console.log('0MQ => Client: '+out);
	conn.sendText(out);

    });

}).listen(8001)

