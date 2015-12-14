<?php
class Controller{
	var $vars = array();
	var $layout = 'default';
	var $action;
	var $params = array();
	var $data = array();
	var $title;

	static $self;
	static $controllername = '';

	function __construct($action=null, $params=array(), $data=array()){
		Controller::$self = $this;

		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		$this->action = $action;
		$this->params = $params;
		$this->data = $data;
	}

	function run(){
		if(method_exists($this, $this->action)){
			call_user_func_array(array($this, $this->action), $this->params);
		}
		else{
			$this->noaction($this->action, $this->params);
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

	function GetUser(){
		if(isset($this->data['user']))
			return $this->data['user'];
		else
			return null;
	}


	function loadModel($name){
		require_once(ROOT.'models/'.strtolower($name).'.php');
		$this->$name = new $name();
		return $this->$name;
	}

	function noaction($action, $params){
		Controller::weberror('404', 'L\'action demandé n\'existe pas.');
	}

	function UserLogin($user){
		$this->data['user'] = $user;
		$_SESSION['user_id'] = $user->GetID();
	}


	static function preload($controller=null, $action=null, $params=array(), $data=array()){
		if(!isset($controller) or empty($controller))
			$controller = DEFAULT_CONTROLLER;

		self::$controllername = $controller;

		$filename = ROOT.'controllers/'.strtolower($controller).'.php';
		if(file_exists($filename)){
			require_once($filename);
			$controller = new $controller($action, $params, $data);

			return $controller;
		}
		else{
			return Controller::weberror('404', 'Le controller demandé n\'existe pas.');
		}
	}

	static function load($controller=null, $action=null, $params=array(), $data=array()){
		$controller = self::preload($controller, $action, $params, $data);
		return $controller->run();
	}

	static function get(){
		return Controller::$self;
	}

	static function weberror($code, $message=null, $data=array()){
		self::load('error', $code, array($message), $data);
		exit();
	}
}
?>
