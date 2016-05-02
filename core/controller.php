<?php
namespace Gamma;

class Controller{
	public $controller;
	public $action;
	protected $vars = array();
	protected $layout = DEFAULT_LAYOUT;
	protected $params = array();
	protected $error;
	protected $js = array();
	protected $jsvars = array();
	protected $models = array();
	static $self;
	static $controllername = '';

	public function __construct($action=null, $params=array(), $data=array()){
		Controller::$self = $this;

		if(!isset($action) or empty($action))
			$action = DEFAULT_ACTION;

		$this->action	= $action;
		$this->params	= $params;
		$this->data  	= $data;
	}

	public function __get($name){
		$fc = substr($name, 0, 1);
		if(ctype_upper($fc)){
			$model = $this->Model($name);
			if($model){
				return $this->$name = $model;
			}
		}
	}

	public function MainInit(){
	}

	public function Init(){
	}

	public function set($vars, $value=null){
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

	public function setjs($vars, $value=null){
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

	public function addjs($name){
		array_push($this->js, $name);
	}

	public function render($filename=null){
		if(empty($filename))
			$filename = $this->action;

		$viewfile = ROOT.'views/pages/'.$this->controller.'/'.$filename.'.php';

		if(file_exists($viewfile)){
			extract($this->vars);

			$jsfiles = array();
			foreach ($this->js as $js) {
				if(file_exists(ROOT.$js)){
					array_push($jsfiles, WEBROOT.'apps/'.$js);
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

	public function form($id, $data=array()){
		$formdata = array();

		if(isset($this->form) and !empty($this->form)){
			if($id == $this->form->ID()){
				$formdata = $this->form->Objects();
			}
		}

		return new Form\View($id, $data, $formdata);
	}

	public function setTitle($title){
		$this->vars['title'] = $title;
	}


	public function Model($name){
		return Model::Load($name);
	}

	public function noaction($action=null, $params=null){
		Controller::weberror('404', 'L\'action demandé n\'existe pas.');
	}

	public function HasError(){
		if($this->error){
			return true;
		}
		return false;
	}

	public function run(){
		$action = 'act_'.$this->action;
		if(method_exists($this, $action)){
			$this->MainInit();
			$this->Init();

			$formid = isset($_POST['formid']) ? $_POST['formid'] : null;
			$formtoken = isset($_POST['token']) ? $_POST['token'] : null;
			$formtime = isset($_POST['time']) ? $_POST['time'] : null;

			if(isset($formid)){
				$this->form = Form::load($formid, $_POST, $this);
			}
			$_SESSION["forms_token"] = null;
			
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
