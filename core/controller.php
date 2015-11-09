<?php
class Controller{
	var $vars = array();
	var $layout = 'default';

	function __construct($action=null, $params=null){
		echo "fasfasfa0";
		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		if(method_exists($this, $action)){
			call_user_func_array(array($this, $action), $params);
		}
		else{
			Controller::load('error', '404', array('L\'action demandé n\'existe pas.'));
		}
	}

	function set($vars){
		$this->vars = array_merge($this->vars, $vars);
	}

	function render($filename){
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

	function loadModel($name){
		require_once(ROOT.'models/'.strtolower($name).'.php');
		$this->$name = new $name();
		return $this->$name;
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
			Controller::load('error', '404', array('Le controller demandé n\'existe pas.'));
		}
	}
}
?>
