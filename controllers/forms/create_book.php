<?php
class form_create_book extends Form{
	var $formfields = array('title', 'description', 'language', 'category', "adult");
	var $user;
	private $Book;
	private $Page;
	private $Answer;

	function init(){
		$Controller  	= Controller::$self;
		$this->Book  	= $Controller->loadModel('book');
		$this->Page  	= $Controller->loadModel('page');
		$this->Answer	= $Controller->loadModel('answer');
		$user        	= $Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			$this->fail();
		}
	}
}