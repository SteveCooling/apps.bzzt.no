<?php defined('BASEPATH') or exit('No direct script access allowed');

require(APPPATH.'libraries/REST_Controller.php');

/**
 * CodeIgniter Rest MQ Controller
 *
 * Extends REST_Controller to provide easy access to 0MQ.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Morten Johansen
 * @license         MIT
 * @link			http://apps.bzzt.no/
 * @version         0.9.0
 */
abstract class REST_MQ_Controller extends REST_Controller
{

	protected $zmq_queue_type;
	protected $zmq_queue_addr;
	
	protected $zmq_context;
	protected $zmq_socket;

	protected function getZMQContext() {
		if(!$this->zmq_context) $this->zmq_context = new ZMQContext();
		return $this->zmq_context;
	}

	protected function getZMQSocket() {
		if(!$this->zmq_socket) {
			$ctx = $this->getZMQContext();
			$this->zmq_socket = $ctx->getSocket($this->zmq_queue_type);
			$this->zmq_socket->connect($this->zmq_queue_addr);
		}
		return $this->zmq_socket;
	}

	protected function sendZMQ($topic, $message) {
		$queue = $this->getZMQSocket();
		return $queue->sendmulti(array($topic, $message));
	}

	protected function sendZMQProgress($progress) {
		if($requestid = $this->get('requestid')) {
			$this->sendZMQ('progress_'.$requestid, $progress);
		}
	}

}
