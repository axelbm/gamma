<?php
class Controller{
	var $vars = array();
	var $layout = DEFAULT_LAYOUT;
	var $action;
	var $params = array();
	var $data = array();
	var $user = null;
	var $form = null;
	var $title;
	var $error;
	var $js = array();
	var $jsvars = array();

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
			$Member = $this->loadModel('member');
			$this->user = $Member->GetByID($_SESSION['user_id']);
		}
	}

	function init(){

	}

	function run(){
		$action = 'act_'.$this->action;
		if(method_exists($this, $action)){
			$this->init();

			$formid = isset($_POST['formid']) ? $_POST['formid'] : null ;

			if(isset($formid)){
				unset($_POST['formid']);
				
				$form = Form::load($formid, $_POST, $this);

				if(!empty($form)){
					$this->form      	= $form;
					$this->formresult	= $form->result;
				}
			}

			call_user_func_array(array($this, $action), $this->params);
		}
		else{
			$this->noaction($this->action, $this->params);
		}
	}

	function set($vars, $value=null){
		if(isset($value)){
			if(is_string($vars)){
				$this->vars[$vars] = $value;
			}
		}else{
			if(is_array($vars)){
				$this->vars = array_merge($this->vars, $vars);
			}else{
				array_push($this->vars, $vars);
			}
		}
	}

	function setjs($vars, $value=null){
		if(isset($value) & !empty($value)){
			if(is_string($vars)){
				$this->jsvars[$vars] = $value;
			}
		}else{
			if(is_array($vars)){
				$this->jsvars = array_merge($this->jsvars, $vars);
			}else{
				array_push($this->jsvars, $vars);
			}
		}
	}

	function addjs($name){
		array_push($this->js, $name);
	}

	function render($filename=null){
		if(empty($filename))
			$filename = $this->action;

		$viewfile = ROOT.'views/pages/'.get_class($this).'/'.$filename.'.php';

		if(file_exists($viewfile)){
			if(file_exists(ROOT.'/controllers/layout/'.$this->layout.'.php')){
				include(ROOT.'/controllers/layout/'.$this->layout.'.php');
				$name = 'layout_'.$this->layout;
				$layout = new $name;
				$this->set($layout->getvars());

			}

			extract($this->vars);

			$this->addjs('views/pages/'.get_class($this).'/js/javascript.js');
			$this->addjs('views/pages/'.get_class($this).'/js/'.$filename.'.js');
			$this->addjs('views/layout/'.$this->layout.'/js/javascript.js');
			$this->addjs('views/pages/'.get_class($this).'/js/'.get_class($this).'.js');

			$jsfiles = array();
			foreach ($this->js as $js) {
				if(file_exists(ROOT.$js)){
					array_push($jsfiles, WEBROOT.$js);
				}
			}

			$jsvars = json_encode($this->jsvars);

			ob_start();
			require($viewfile);
			$content_for_layout = ob_get_clean();

			if($this->layout == false){
				echo $content_for_layout;
			}else{
				$path = ROOT.'views/layout/'.$this->layout.'/';
				if(file_exists($path.$filename.'.php')){
					require($path.$filename.'.php');
				}else{
					require($path.'index'.'.php');
				}
			}
		}else{
			Controller::weberror('500', 'tew');
		}
	}

	function setTitle($title){
		$this->vars['title'] = $title;
	}


	function loadModel($name){
		$file = ROOT.'models/'.strtolower($name).'.php';
		
		if(file_exists($file)){
			require_once($file);
			$class = Model::Get('model_'.strtolower($name));
			$class->SetController($this);
			return $class;
		}else{
			Controller::weberror('404', 'Le model demandé n\'existe pas.');
		}
	}

	function noaction($action=null, $params=null){
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
