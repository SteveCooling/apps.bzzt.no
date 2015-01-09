about
-----

This is just a showcase web application. Used for testing ideas for client/server interaction.</p>

The client is HTML5 and Javascript augmented by jQuery, Bootstrap, WebSockets and some pink fairy dust.
On the server side, CodeIgniter (PHP) with the REST_Controller extension provides the REST resources.
The REST_Controller has been
<a href="https://gist.github.com/SteveCooling/db307d55df395a56a58e">slightly extended</a>
to provide a convenient means for publishing info and request progress information for REST resources that
take time to return.

To provide support for asynchronous communication, node.js serves a WebSocket server, and two ZeroMQ (0MQ) queues.
The first queue is a push-pull queue that lets anything on the server push events to the hub.
The hub then publishes the events to the second, pub-sub queue. This queue lets any thread subscribe to any event
type/topic.

Each WebSocket client can send in "subscribe" messages, which makes the client's server thread subscribe to the 
corresponding event type in the pub-sub queue. Each subscribed message from the queue is then immediately sent
to the client over the WebSocket, where the client code runs a handler function for that message type.

contact
-------

If you're worthy, you can look up the Tech-c Handle on my domain name. May the force be with you ;-)
