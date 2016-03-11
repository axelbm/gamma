<?php
class Form_New {
	private $id;
	private $failed;
	private $default_objects  	= array();
	private $blacklisted_items	= array();
	private $action;
	private $objects = array();
	private $message = array();
	protected $Controller;

	public function __construct($id, $data, $controller){
		$this->id = $id;
		$this->Controller = $controller;

		$this->BlacList('formid');
		$this->Init();

		$inputs = array();
		foreach ($this->default_objects as $id) {
			$inputs[$id] = null;
		}

		$data        	= array_merge($inputs, $data);
		$this->failed	= false;

		foreach ($data as $id => $value) {
			if(!in_array($id, $this->blacklisted_items)){
				$obj = new Form_Object($id, $value);

				$method = "check_$id";
				if(method_exists($this, $method)){
					$this->$method($obj);
				}else{
					$this->DefaultCheck($obj);
				}

				if(!$obj->IsValid()){
					$this->failed = true;
				}

				$this->objects[$id] = $obj;
			}
		}

		if($this->failed){
			$this->Failed();
		}else{
			$this->successful = true;
			$this->Successful();
		}

		$this->End();
	}

	public function Analize(){
		
	}

	function __get($name){
		return $this->Controller->$name;
	}

	public function ID(){
		return $this->id;
	}

	public function Object($id){
		return $this->objects[$id];
	}

	public function Objects(){
		return $this->objects;
	}

	public function IsSuccessful(){
		return $this->successful;
	}

	protected function DefaultCheck($obj){
		$obj->Valid();
	}

	protected function Init(){

	}

	protected function Successful(){

	}

	protected function Failed(){

	}

	protected function End(){

	}

	protected function Fail(){
		$this->failed = true;
	}

	protected function BlacList($items){
		if (is_string($items)){
			array_push($this->blacklisted_items, $items);
		}
		elseif(is_array($items)){
			foreach ($items as $item) {
				if (is_string($item)){
					array_push($this->blacklisted_items, $item);
				}
			}
		}
	}

	protected function DefaultObject($items){
		if (is_string($items)){
			array_push($this->default_objects, $items);
		}
		elseif(is_array($items)){
			foreach ($items as $item) {
				if (is_string($item)){
					array_push($this->default_objects, $item);
				}
			}
		}
	}

	//Tool

	public function Value($obj){
		if(is_string($obj))
			$obj = $this->Object($obj);

		return $obj->Value();
	}

	public function IsEmail($obj){
		if(is_string($obj))
			$obj = $this->Object($obj);

		$str = $obj->Value();

		if(filter_var($str, FILTER_VALIDATE_EMAIL))
			return true;

		return false;
	}

	public function ValidString($obj){
		if(is_string($obj))
			$obj = $this->Object($obj);

		$str = $obj->Value();

		if(!empty($str))
			return true;

		return false;
	}

	public function HTMLEscape($obj){
		if(is_string($obj))
			$obj = $this->Object($obj);
		
		return htmlspecialchars($obj->Value());
	}

	///

	static function load($id, $data, $controller){
		$formfile = ROOT.'controllers/forms/'.$id.'.php';

		if(file_exists($formfile)){
			$formclass = 'form_'.$id;

			require($formfile);
			$form = new $formclass($id, $data, $controller);
			return $form;
		}else{
			return null;
		}
	}
}