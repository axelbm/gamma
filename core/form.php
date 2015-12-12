<?php
class Form{
	var $data = array();
	var $isvalid = true;
	var $varname = '';
	var $formfields = array();

	public function __construct($data){
		if(empty($this->formfields)){
			foreach ($data as $key => $value) {
				$this->data[$key] = array();
				$this->data[$key]['value'] = $value;
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

		foreach ($this->data as $key => $value) {
			$value = $value['value'];
			$method = 'check_'.$key;
			$feedback = false;
			$this->varname = $key;

			if(method_exists($this, $method)){
				$feedback = $this->$method($value);
			}else{
				$feedback = $this->varcheck($value);
			}

			if($feedback == false){
				$this->isvalid = false;
			}
		}

		if($this->isvalid){
			$this->success();
		}else{
			$this->fail();
		}
	}

	public function GetData(){
		return $this->data;
	}

	protected function varcheck($var){
		$value = array();
		if(isset($var) & !empty($var)){
			return true;
		}else{
			$this->error('La donnée n\'est pas valide.');
			return false;
		}
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

	static function load($formid, $data){
		$formfile = ROOT.'controllers/forms/'.$formid.'.php';

		if(file_exists($formfile)){
			$formclass = 'form_'.$formid;

			require($formfile);
			return new $formclass($data);
		}
	} 
}
?>