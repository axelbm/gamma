<?php
namespace Gamma;

class Controller{
	private $vars = array();
	private $formvars = array();
	var $layout = DEFAULT_LAYOUT;
	var $controller;
	var $action;
	var $params = array();
	var $user = null;
	var $error;
	var $js = array();
	var $jsvars = array();
	var $models = array();

	static $self;
	static $controllername = '';

	function __construct($action=null, $params=array(), $data=array()){
		Controller::$self = $this;

		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		$this->action	= $action;
		$this->params	= $params;
		$this->data  	= $data;
	}

	function __get($name){
		$fc = substr($name, 0, 1);
		if(ctype_upper($fc)){
			$model = $this->Model($name);
			if($model){
				return $this->$name = $model;
			}
		}
		
	}
	
	function MainInit(){
	}

	function Init(){
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

	function ToForm($key, $value=null){
		if(isset($value)){
			if(is_string($key)){
				$this->formvars[$key] = $value;
			}
		}else{
			if(is_array($key)){
				$this->formvars = array_merge($this->formvars, $key);
			}else{
				array_push($this->formvars, $key);
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

		$viewfile = ROOT.'views/pages/'.$this->controller.'/'.$filename.'.php';

		if(file_exists($viewfile)){
			if(file_exists(ROOT.'/controllers/layout/'.$this->layout.'.php')){
				require_once(ROOT.'/controllers/layout/'.$this->layout.'.php');
				$name = 'layout_'.$this->layout;
				$layout = new $name;
				$this->set($layout->getvars());

			}

			extract($this->vars);

			$this->addjs('views/pages/'.$this->controller.'/js/javascript.js');
			$this->addjs('views/pages/'.$this->controller.'/js/'.$filename.'.js');
			$this->addjs('views/layout/'.$this->layout.'/js/javascript.js');
			$this->addjs('views/pages/'.$this->controller.'/js/'.$this->controller.'.js');

			$jsfiles = array();
			foreach ($this->js as $js) {
				if(file_exists(ROOT.$js)){
					array_push($jsfiles, WEBROOT.$js);
				}
			}

			$jsvars = json_encode($this->jsvars);

			ob_start();
			require_once($viewfile);
			$content_for_layout = ob_get_clean();

			if($this->layout == false){
				echo $content_for_layout;
			}else{
				$path = ROOT.'views/layout/'.$this->layout.'/';
				if(file_exists($path.$filename.'.php')){
					require_once($path.$filename.'.php');
				}else{
					require_once($path.'index'.'.php');
				}
			}
		}else{
			Controller::weberror('500', 'tew');
		}
	}

	function setTitle($title){
		$this->vars['title'] = $title;
	}


	function Model($name){
		return Model::Load($name);
	}

	function noaction($action=null, $params=null){
		Controller::weberror('404', 'L\'action demandé n\'existe pas.');
	}

	function UserLogin($user){
		$this->user = $user;
		$_SESSION['user_id'] = $user->ID();
	}

	function HasError(){
		if($this->error){
			return true;
		}
		return false;
	}

	function run(){
		$action = 'act_'.$this->action;
		if(method_exists($this, $action)){
			$this->MainInit();
			$this->Init();

			$formid = isset($_POST['formid']) ? $_POST['formid'] : null;
			$newform = isset($_POST['newform']) ? true : false;

			if(isset($formid)){
				if($newform){
					$this->newform = Form::load($formid, $_POST, $this->formvars);
				}else{
					unset($_POST['formid']);
					$this->form = Old\Form::load($formid, $_POST, $this);
				}
			}
			
			call_user_func_array(array($this, $action), $this->params);
		}
		else{
			$this->noaction($this->action, $this->params);
		}
	}

	static function load($controller=null, $action=null, $params=null, $data=null){
		if(!isset($controller) or empty($controller))
			$controller = DEFAULT_CONTROLLER;

		self::$controllername = $controller;
		$cn = $controller;

		$filename = ROOT.'controllers/'.strtolower($controller).'.php';
		if(file_exists($filename)){
			require_once($filename);
			$class = 'Apps\Controller\\'.$controller;

			$controller = new $class($action, $params, $data);
			$controller->controller = $cn;
			$controller->run();
			
			return $controller;
		}
		else{
			return Controller::weberror('404', 'Le controller demandé n\'existe pas.');
		}
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
