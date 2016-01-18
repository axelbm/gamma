<?php
class Controller{
	var $vars = array();
	var $layout = DEFAULT_LAYOUT;
	var $action;
	var $params = array();
	var $data = array();
	var $user = null;
	var $form = null;
	var $formdata = null;
	var $title;
	var $error;

	static $self;
	static $controllername = '';

	function __construct($action=null, $params=array(), $data=array()){
		Controller::$self = $this;

		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		$this->action	= $action;
		$this->params	= $params;
		$this->data  	= $data;

		if(isset($_SESSION['user_id']) & !empty($_SESSION['user_id'])){
			$this->user = Member::GetByID($_SESSION['user_id']);
		}
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

		$viewfile = ROOT.'views/pages/'.get_class($this).'/'.$filename.'.php';

		if(file_exists($viewfile)){
			extract($this->vars);

			ob_start();
			require($viewfile);
			$content_for_layout = ob_get_clean();

			if($this->layout == false){
				echo $content_for_layout;
			}else{
				$path = ROOT.'views/layout/'.$this->layout.'/';
				if(file_exists($path.get_class($this).'.php')){
					require($path.get_class($this).'.php');
				}else{
					require($path.'index.php');
				}
			}
		}else{
			Controller::weberror('500', '');
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

	function UserLogin($user){
		$this->user = $user;
		$_SESSION['user_id'] = $user->GetID();
	}

	function HasError(){
		if($this->error){
			return true;
		}
		return false;
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

	static function load($controller=null, $action=null, $params=null, $data=null){
		$controller = self::preload($controller, $action, $params, $data);
		return $controller->run();
	}

	static function get(){
		return Controller::$self;
	}

	static function weberror($code, $message=null, $data=null){
		self::load('error', $code, array($message), $data);
		exit();
	}
}
?>
