<?php
class layout_bootstrap extends Layout{

	function init(){
		$Controller = Controller::$self;
		// $Member = $Controller->loadModel('member');
		$user = $Controller->user;

		$this->set('user', $user);
	}

	function index(){

	}
}