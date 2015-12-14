<?php
class error extends Controller{

	function run(){
		$code = $this->action;
		$params = $this->params;

		$method = 'err_'.$code;
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

	function err_404($params){
		$data = array(
			'message' => $params[0]
		);
		$this->set($data);
		$this->render('err_404');
	}
}
?>