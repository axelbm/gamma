<?php
class Controller{
	var $vars = array();
	var $layout = DEFAULT_LAYOUT;
	var $controller;
	var $action;
	var $params = array();
	var $user = null;
	var $error;
	var $js = array();
	var $jsvars = array();
	var $models = array();
	var $Database;

	static $self;
	static $controllername = '';

	function __construct($action=null, $params=array(), $data=array()){
		Controller::$self = $this;

		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		$this->action	= $action;
		$this->params	= $params;
		$this->data  	= $data;

		$this->Database = new Database('localhost', DB_NAME, DB_NAME, DB_PSW);

		if(isset($_SESSION['user_id']) & !empty($_SESSION['user_id'])){
			$this->user = $this->Member->GetByID($_SESSION['user_id']);
		}else{
			if(isset($_COOKIE['connection_token']) & !empty($_COOKIE['connection_token'])){
				$this->user = $this->Member->GetByConnectionToken($_COOKIE['connection_token']);
			}
		}
	}

	function __get($name){
		$fc = substr($name, 0, 1);
		if(ctype_upper($fc)){
			$this->$name = $this->loadModel($name);
			return $this->$name;
		}
		
	}

	function init(){

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


	function loadModel($name){
		$file = ROOT.'models/'.strtolower($name).'.php';
		
		if(file_exists($file)){
			require_once($file);

			$obj_file = ROOT.'objects/'.strtolower($name).'.php';

			if(file_exists($obj_file))
				require_once $obj_file;

			$modelname = 'model_'.strtolower($name);

			if(!isset($this->models[$modelname]) | empty($this->models[$modelname])) {
				$model = new $modelname();
				$model->SetDatabase($this->Database);

				$model->Init();

				$this->models[$modelname] = $model;
			}

			return $this->models[$modelname];
		}else{
			//Controller::weberror('404', 'Le model demandé n\'existe pas.');
		}
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
			$this->init();

			$formid = isset($_POST['formid']) ? $_POST['formid'] : null;
			$newform = isset($_POST['newform']) ? true : false;

			if(isset($formid)){
				if($newform){
					$this->newform = Form_New::load($formid, $_POST, $this);
				}else{
					unset($_POST['formid']);
					$this->form = Form::load($formid, $_POST, $this);
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
			$class = 'controller_'.$controller;

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
