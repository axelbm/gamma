<?php
class form_test extends Form_New{

	protected function Init(){
		$this->DefaultObject(['email', 'password', 'a', 'v']);
	}

	protected function check_email($obj){
		if($this->IsEmail($obj)){
			$obj->Status(1);
			$obj->Message("Valid Email");
			$obj->Valid();
		}else{
			$obj->Status(3);
			$obj->Message("Invalid Email");
		}
	}

	protected function End(){
		var_dump($this);
	}
}