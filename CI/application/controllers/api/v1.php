<?php

require(APPPATH.'libraries/REST_MQ_Controller.php');

class V1 extends REST_MQ_Controller {
	
	var $zmq_queue_type = ZMQ::SOCKET_PUSH;
	var $zmq_queue_addr = 'tcp://127.0.0.1:31336';

    public function ip_get() {
		$this->response(array(
			'ip' => $_SERVER['REMOTE_ADDR'],
		));    
    }

    public function randomafter3_get() {

		srand();

		$this->sendZMQProgress(0);

		for ($progress = 0; $progress <= 100; $progress +=20) {
		  usleep(rand(300,900)*1000);
		  $this->sendZMQProgress($progress);
		}

		$this->response(array(
			'rand' => rand(0,65535),
		));    
    }

}
