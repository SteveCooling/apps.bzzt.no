<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>apps.bzzt.no</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="/dist/ladda-themeless.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="http://getbootstrap.com/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">API bonanza</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#home">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
            <li><p class="navbar-text" id="navbarClock">MOOK</p></li>
		  </ul>
	        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top: 60px;">

		<a id="home"><h1>home</h1></a>

		<div class="panel panel-default">
			<div class="panel-heading">Available APIs</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-6 col-md-4">
						<h3>Client IP</h3>
						<p>Simple REST resource that returns the Client IP as seen by the server.</p>
						<div class="btn-group btn-group-sm">
							<button type="button" id="ipButton" class="btn btn-primary" data-toggle="modal" data-target="#dataModal">
								Show IP
							</button>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<h3>Random Number</h3>
						<p>Resource that generates a random number between 0 and 65535. The service deliberately takes a few seconds to return.</p>
						<div class="btn-group btn-group-sm">
							<button type="button" id="randButton" class="btn btn-primary" data-toggle="modal" data-target="#dataModal">
								Request
							</button>
						</div>
					</div>
					<div class="col-xs-6 col-md-4">
						<h3>WebSocket Clock</h3>
						<p>Subscribe to the "timeserver" events on the WebSocket, and update the clock div in the upper right corner when events are received.</p>
						<div class="btn-group btn-group-sm">
							<button type="button" id="clockStartButton" class="btn btn-success">
								Start
							</button>
							<button type="button" id="clockStopButton" class="btn btn-danger">
								Stop
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		
		<!-- Modal -->
		<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
			      
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="dataModalLabel">Title</h4>
		      </div>
		      <div class="modal-body" id="dataModalBody">
		        Contents
		      </div>
		      <div class="modal-body" id="dataModalProgress">
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
		      </div>
		    </div>
		  </div>
		</div>

		<a id="about"><h1>about</h1></a>
		<p>This is just a showcase web application. Used for testing ideas for client/server interaction.</p>
		<p>
			The client is HTML5 and Javascript augmented by jQuery, Bootstrap, WebSockets and some pink fairy dust.
			On the server side, CodeIgniter (PHP) with the REST_Controller extension provides the REST resources.
			The REST_Controller has been
			<a href="https://gist.github.com/SteveCooling/db307d55df395a56a58e">slightly extended</a>
			to provide a convenient means for publishing info and request progress information for REST resources that
			take time to return.
		</p>
		<p>
			To provide support for asynchronous communication, node.js serves a WebSocket server, and two ZeroMQ (0MQ) queues.
			The first queue is a push-pull queue that lets anything on the server push events to the hub.
			The hub then publishes the events to the second, pub-sub queue. This queue lets any thread subscribe to any event
			type/topic.
		</p>
		<p>
			Each WebSocket client can send in "subscribe" messages, which makes the client's server thread subscribe to the 
			corresponding event type in the pub-sub queue. Each subscribed message from the queue is then immediately sent
			to the client over the WebSocket, where the client code runs a handler function for that message type.
		</p>
		<a id="contact"><h1>contact</h1></a>
		<p>
			If you're worthy, you can look up the Tech-c Handle on my domain name. May the force be with you ;-)
		</p>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
	<script src="/dist/spin.min.js"></script>
	<script src="http://jquery-json.googlecode.com/files/jquery.json-2.2.min.js"></script>
	<script src="/js/jquery.websocket.js"></script>
	<script src="/js/jquery.mqsocket.js"></script>
	<script src="/js/sprintf.min.js"></script>
	<script>
	$('#navbarClock')[0].innerHTML = '<i class="fa fa-cog fa-spin"></i>';

	var progressBar = function(id) {
		return '<div class="progress"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="progressBar_'+id+'"></div></div>';

	}

	var ws = $.mqsocket("ws://apps.bzzt.no:8001/", {});

	setTimeout(function() {
		ws.subscribe('timeserver', function(e) {
			date = new Date(e.data);

			$('#navbarClock')[0].innerHTML = sprintf("%02d:%02d:%02d",
				date.getHours(),
				date.getMinutes(),
				date.getSeconds()
			);
		});
	}, 500);
	  
	$('#ipButton').on('click', function () {
		$('#dataModalLabel')[0].innerHTML='Client IP';
		$('#dataModalBody')[0].innerHTML='<i class="fa fa-cog fa-spin" style="color: #808080;"></i>';

		$.ajax({
	    	url: "http://apps.bzzt.no/api/v1/ip.json"
	    }).then(function(data) {
	    	//alert(data.ip);
			$('#dataModalBody')[0].innerHTML = data.ip;
	    });
	})

	$('#randButton').on('click', function () {
		var requestid = Math.floor(Math.random() * 100000) + 100000;
		
		$('#dataModalLabel')[0].innerHTML='Random number';
		$('#dataModalBody')[0].innerHTML=progressBar(requestid);

		ws.subscribe('progress_'+requestid, function(e) {
			$('#progressBar_'+requestid).css('width', e.data+'%').attr('aria-valuenow', e.data)
		});

		$.ajax({
	    	url: "http://apps.bzzt.no/api/v1/randomafter3.json?requestid="+requestid
	    }).then(function(data) {
			$('#dataModalBody')[0].innerHTML = data.rand;
			ws.unsubscribe('progress_'+requestid);
	    });
	})

	$('#clockStartButton').on('click', function () {
		ws.send('subscribe','timeserver');
	})

	$('#clockStopButton').on('click', function () {
		ws.send('unsubscribe','timeserver');
		$('#navbarClock')[0].innerHTML = 'unsubscribed' 
	})
	
	</script>
  </body>
</html>