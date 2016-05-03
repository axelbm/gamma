<?php
namespace Apps\Form\Book;

class Action extends \Gamma\Form{
	private $book;
	private $user;

	protected function Init(){
		$this->DefaultObject(['action']);

		$user = $this->controller->User();

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->Fail();
		}

		$this->book = $this->controller->book;
	}

	function Failed(){
		header("Location: " . $_SERVER['REQUEST_URI']);
		exit;
	}

	function Successful(){
		$action = $this->Value('action');
		
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
			$this->Failed();
		}

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}
}