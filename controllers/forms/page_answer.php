<?php
class form_page_answer extends Form{
	var $formfields = array('answer');
	private $page;
	private $cpage;
	private $answer;
	private $book;

	function init(){
		$this->book	= $this->Controller->book;
		$user      	= $this->Controller->user;

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
			$bookid = $this->book->ID();
			$link	= $this->User_book->GetLink($this->user->GetID(), $bookid);
			$progression = $link['progression'];

			if($progression){
				$id = $progression[count($progression)-1][1];
				$an = $this->Answer->GetByID($id);
				$this->cpage = $this->Page->GetByID($an['destination']);
			}else{
				$id = $this->Book->GetByID($bookid)->StartingPage();
				$this->cpage = $this->Page->GetByID($id);
			}

			$answer = $this->Answer->GetByID($answer);
			$page = $this->Page->GetByID($answer['destination']);

			if(!empty($page)){
				if($answer['page'] == $this->cpage->ID()){
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
		$id = $this->page->ID();
		$pageid = $this->cpage->ID();
		$bookid = $this->book->ID();

		$data = array($pageid, $this->answer['id']);

		$this->User_book->AddPage($this->user->ID(), $bookid, $data);

		header("Location: " . $_SERVER['REQUEST_URI']);
		exit();
	}
}