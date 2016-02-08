<?php
class Form{
	protected $Controller;
	protected $varname;
	protected $formfields;
	var $id;
	var $data       	= array();
	var $isvalid    	= true;
	var $success    	= false;
	var $formerror  	= '';
	var $formsuccess	= '';
	var $result     	= '';

	public function __construct($data, $controller){
		$this->Controller = $controller; 

		if(empty($this->formfields)){
			foreach ($data as $key => $value) {
				$this->data[$key]         	= array();
				$this->data[$key]['value']	= $value;
			}
		}else{
			foreach ($this->formfields as $key) {
				$this->data[$key] = array();
				$this->data[$key]['error'] = null;

				if(isset($data[$key])){
					$this->data[$key]['value'] = $data[$key];
				}
				else{
					$this->data[$key]['value'] = null;
				}
			}
		}

		$this->init();

		foreach ($this->data as $key => $value) {
			$this->varname = $key;
			$value = $value['value'];
			$a = array();
			$keys = explode('_', $key);
			

			for ($i=count($keys); $i > 0; $i--) { 
				$k = implode('_', array_slice($keys, 0, $i));
				$m = 'check_'.$k;

				if(method_exists($this, $m)){
					$method = $m;
					$a = array_slice($keys, $i, count($keys));
					break;
				}else{
					$method = 'varcheck';
					$a = array($keys);
				}
			}

			array_unshift($a, $value);
			$feedback = call_user_func_array(array($this, $method), $a);

			if($feedback == false){
				$this->isvalid = false;
			}
		}

		unset($varname);

		if($this->isvalid){
			$this->success();
		}else{
			$this->fail();
		}
	}

	protected function init(){

	} 

	public function GetData(){
		return $this->data;
	}

	protected function varcheck($var){
		return true;
	}

	protected function error($key, $error=null){
		if(!isset($error) | empty($error)){
			$error = $key;
			$key = $this->varname;
		}

		if(isset($this->data[$key])){
			$this->data[$key]['error'] = $error;
		}
	}

	protected function formerror($error){
		$this->formerror = $error;
	}

	protected function formsuccess($success){
		$this->formsuccess = $success;
	}

	protected function set($key, $value=null){
		if(!isset($error)){
			$value = $key;
			$key = $this->varname;
		}

		if(isset($this->data[$key])){
			$this->data[$key]['value'] = $value;
		}
	}

	protected function get($key=null){
		if(!isset($key))
			$key = $this->varname;

		if(isset($this->data[$key])){
			return $this->data[$key];
		}
	}

	protected function key(){
		return $this->varname;
	}

	protected function value($key){
		if(!isset($key))
			$key = $this->varname;

		if(isset($this->data[$key])){
			return $this->data[$key]['value'];
		}
	}

	protected function success(){

	}

	protected function fail(){

	}

	static function load($formid, $data, $controller){
		$formfile = ROOT.'controllers/forms/'.$formid.'.php';

		if(file_exists($formfile)){
			$formclass = 'form_'.$formid;

			require($formfile);
			$form = new $formclass($data, $controller);
			$form->id = $formid;
			return $form;
		}else{
			return null;
		}
	} 
}
?>