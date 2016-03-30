<?php
namespace Apps\Form\_Old;

class form_book_action extends \Gamma\Old\Form{
	var $formfields = array('action');
	private $Link;
	private $user;

	function init(){
		$this->Link	= $this->Controller->User_book;
		$this->book	= $this->Controller->book;
		$user      	= $this->Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			$this->fail();
			exit;
		}
	}

	function fail(){
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit;
	}

	function success(){
		$action = $this->value('action');
		
		if($action == 'follow'){
			$this->User_book->Follow($this->user->ID(), $this->book->ID());
		}
		elseif($action == 'like'){
			$this->User_book->Like($this->user->ID(), $this->book->ID());
		}
		elseif($action == 'dislike'){
			$this->User_book->Dislike($this->user->ID(), $this->book->ID());
		}
		elseif($action == 'restart'){
			$this->User_book->RemoveProgression($this->user->ID(), $this->book->ID());
		}
		else{
			$this->fail();
		}

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}
}