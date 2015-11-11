<?php
class error extends Controller{

	function __construct($code, $params){
		$method = 'err'.$code;
		if(method_exists($this, $method)){
			$this->$method($params);
		}else{
			$this->index($code, $params[0]);
		}
	}

	function index($code, $message='error'){
		$data = array(
			'code' => $code,
			'message' => $message
		);
		$this->set($data);
		$this->render('index');
	}

	function err404($params){
		$data = array(
			'message' => $params[0]
		);
		$this->set($data);
		$this->render('err404');
	}
}
?>