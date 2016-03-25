<?php
namespace Apps\Controller;

class Error extends \Apps\Controller{

	function run(){
		$code = $this->action;
		$params = $this->params;
		$this->error = $params[0] or 'error';

		$method = 'act_err_'.$code;
		if(method_exists($this, $method)){
			$this->$method($params);
		}else{
			$this->act_index($code, $params[0]);
		}
	}

	function act_index($code, $message='error'){
		$data = array(
			'code' => $code,
			'message' => $message
		);
		$this->set($data);
		$this->render('index');
	}

	function act_err_404($params){
		$data = array(
			'message' => $params[0]
		);
		$this->set($data);
		$this->render('err_404');
	}
}
?>