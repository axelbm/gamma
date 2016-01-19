<?php
class layout_bootstrap extends Layout{
	function __construct(){

	}

	function getvars(){
		$Controller = Controller::$self;
		$Member = $Controller->loadModel('member');
		$user = $Member->GetByID($Controller->userid);

		$vars = array('user'=>$user);

		return $vars;
	}
}