<?php
namespace Gamma;

class Form {
	protected $id;
	protected $failed;
	protected $controller;
	protected $default_objects  	= array();
	protected $blacklisted_items	= array();
	protected $objects          	= array();
	protected $message          	= array();

	public function __construct($id, $data, $controller){
		$this->id        	= $id;
		$this->controller	= $controller;

		$this->BlacList('formid', 'token');
		$this->Init();

		$inputs = array();
		foreach ($this->default_objects as $id) {
			$inputs[$id] = null;
		}

		$data        	= array_merge($inputs, $data);
		$this->failed	= false;

		foreach ($data as $id => $value) {
			if(!in_array($id, $this->blacklisted_items)){
				$obj = new Form\Object($id, $value);

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

	function __get($name){
		$fc = substr($name, 0, 1);
		if(ctype_upper($fc)){
			$model = $this->Model($name);
			if($model){
				return $this->$name = $model;
			}
		}
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

	protected function Model($name){
		return Model::Load($name);
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

	public function Action($action=null){
		if(!empty($action))
			$this->action = $action;

		return $this->action;
	}

	public function ActionData(){
		return $this->actiondata;
	}

	public function FormData(){
		return $this->formdata;
	}

	public function ClientData(){
		return $this->clientdata;
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
		$formfile = ROOT."forms/{$controller->controller}/$id.php";
		$formclass = "Apps\Form\\{$controller->controller}\\$id";

		if(!file_exists($formfile)){
			$formfile = ROOT."forms/$id.php";
			$formclass = "Apps\Form\\$id";
		}

		if(file_exists($formfile)){
			require($formfile);
			$form = new $formclass($id, $data, $controller);
			return $form;
		}else{
			die($formfile);
			return null;
		}
	}
}