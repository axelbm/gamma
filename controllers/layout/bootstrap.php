<?php
class layout_bootstrap extends Layout{

	function init(){
		$Controller = Controller::$self;
		$Member = $Controller->loadModel('member');
		$user = $Member->GetByID($Controller->userid);

		$this->set('user', $user);
	}

	function index(){

	}
}