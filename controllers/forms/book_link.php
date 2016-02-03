<?php
class form_book_link extends Form{
	var $formfields = array('action');
	private $Link;
	private $user;

	function init(){
		$this->Link	= $this->Controller->loadModel('user_book');
		$this->book	= $this->Controller->book;
		$user      	= $this->Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			$this->fail();
		}
	}

	function success(){
		$action = $this->value('action');
		
		if($action == 'follow'){
			$this->Link->Follow($this->user->GetID(), $this->book['id']);
		}elseif($action == 'favorite'){
			$this->Link->Favorite($this->user->GetID(), $this->book['id']);
		}else{
			$this->fail();
		}

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}
}