<?php
class form_page_answer extends Form{
	var $formfields = array('answer');
	private $Page;
	private $Book;
	private $Link;
	private $page;
	private $cpage;
	private $answer;
	private $book;

	function init(){
		$this->Page  	= $this->Controller->loadModel('page');
		$this->Book  	= $this->Controller->loadModel('book');
		$this->Answer	= $this->Controller->loadModel('answer');
		$this->Link  	= $this->Controller->loadModel('user_book');
		$this->book  	= $this->Controller->book;
		$user        	= $this->Controller->user;

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
			$bookid = $this->book['id'];
			$link	= $this->Link->GetLink($this->user->GetID(), $bookid);
			$progression = $link['progression'];

			if($progression){
				$id = $progression[count($progression)-1][1];
				$an = $this->Answer->GetByID($id);
				$this->cpage = $this->Page->GetByID($an['destination']);
			}else{
				$id = $this->Book->GetByID($bookid)['starting_page'];
				$this->cpage = $this->Page->GetByID($id);
			}

			$answer = $this->Answer->GetByID($answer);
			$page = $this->Page->GetByID($answer['destination']);

			if(!empty($page)){
				if($answer['page'] == $this->cpage['id']){
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
		$pageid = $this->cpage['id'];
		$bookid = $this->book['id'];

		$data = array($pageid, $this->answer['id']);

		$this->Link->AddPage($this->user->GetID(), $bookid, $data);

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}
}