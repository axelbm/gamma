<?php
class error extends Controller{

	function __construct($code, $params){
		$this->index($code, $params[0]);
	}

	public function index($code, $message){
		$data = array(
			'code' => $code,
			'message' => $message
		);
		$this->set($data);
		$this->render('index');
	}
}
?>