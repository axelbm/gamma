<?php
class Controller{
	var $vars = array();
	var $layout = 'default';
	var $action = 'index';
	var $title;

	function __construct($action=null, $params=null){
		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		if(method_exists($this, $action)){
			$this->action = $action;
			call_user_func_array(array($this, $action), $params);
		}
		else{
			$this->noaction($action, $params);
		}
	}

	function set($vars){
		$this->vars = array_merge($this->vars, $vars);
	}

	function render($filename=null){
		if(empty($filename))
			$filename = $this->action;

		extract($this->vars);

		ob_start();
		require(ROOT.'views/pages/'.get_class($this).'/'.$filename.'.php');
		$content_for_layout = ob_get_clean();

		if($this->layout == false){
			echo $content_for_layout;
		}else{
			require(ROOT.'views/layout/'.$this->layout.'.php');
		}
	}

	function setTitle($title){
		$this->vars['title'] = $title;
	}



	function loadModel($name){
		require_once(ROOT.'models/'.strtolower($name).'.php');
		$this->$name = new $name();
		return $this->$name;
	}

	function noaction($action, $params){
		Controller::weberror('404', 'L\'action demandé n\'existe pas.');
	}

	static function load($controller=null, $action=null, $params=null){
		if(!isset($controller) or empty($controller))
			$controller = DEFAULT_CONTROLLER;

		$filename = ROOT.'controllers/'.strtolower($controller).'.php';
		if(file_exists($filename)){
			require_once($filename);
			return new $controller($action, $params);
		}
		else{
			Controller::weberror('404', 'Le controller demandé n\'existe pas.');
		}
	}

	static function weberror($code, $message){
		Controller::load('error', $code, array($message));
		exit;
	}
}
?>
