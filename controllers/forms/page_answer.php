<?php
class form_page_answer extends Form{
	var $formfields = array('page', 'book', 'answer');
	private $Page;
	private $Link;
	private $page;
	private $answer;

	function init(){
		$Controller  	= Controller::$self;
		$this->Page  	= $Controller->loadModel('page');
		$this->Answer	= $Controller->loadModel('answer');
		$this->Link  	= $Controller->loadModel('user_book');
		$user        	= $Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			$this->fail();
		}
	}
	
	function check_answer($answer){
		if(isset($answer) & !empty($answer)){
			$answer = intval($answer);

			$answer = $this->Answer->GetByID($answer);
			$page = $this->Page->GetByID($answer['destination']);

			if(!empty($page)){
				if($answer['page'] == $this->value('page')){
					$this->answer	= $answer;
					$this->page  	= $page;
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	
	function fail(){
	}

	function success(){
		$id = $this->page['id'];
		$pageid = $this->value('page');
		$bookid = $this->value('book');

		$data = array($pageid, $this->answer['id']);

		$this->Link->AddPage($this->user->GetID(), $bookid, $data);
	}
}