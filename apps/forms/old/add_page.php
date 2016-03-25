<?php
class form_add_page extends Form{
	var $formfields = array('answer', 'title', 'content', 'book', "pageid", 'page', 'action');
	var $user;
	var $selected_page;
	var $book;
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

	function check_answer($answer){
		if(isset($answer) & !empty($answer)){
			return true;
		}else{
			return false;
		}
	}

	function check_title($title){
		return true;
	}
	
	function check_content($content){
		if($this->value('action') == 'nav_new'){
			if(isset($content) & !empty($content)){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
	}

	function check_page($page){
		if($this->value('action') == 'nav_retake'){
			if(isset($page) & !empty($page)){
				$page = intval(substr($page, 5));

				if(!empty($page)){
					$this->selected_page = $page;
					return true;
				}else{
					$this->error('gnaa');
					return false;
				}
			}else{
				$this->error('gnaa');
				return false;
			}
		}else{
			return true;
		}
	}
	
	function fail(){
		$Controller = Controller::$self;
		$Controller->setjs('hash',        	'add_page');
		$Controller->setjs('page_add_tab',	$this->value('action'));
		$Controller->setjs('page_select', 	$this->value('page'));
	}

	function success(){
		if($this->value('action') == 'nav_new'){
			$page = array(
				'book'   	=> $this->value('book'),
				'title'  	=> $this->value('title')?: null,
				'content'	=> $this->value('content'),
				'creator'	=> $this->user->ID()
			);

			$id = $this->Page->Create($page);

			$answer = array(
				'page'       	=> $this->value('pageid'),
				'destination'	=> $id,
				'content'    	=> $this->value('answer'),
				'creator'    	=> $this->user->ID()
			);

			$this->Answer->Create($answer);
		}elseif($this->value('action') == 'nav_retake'){
			$answer = array(
				'page'       	=> $this->value('pageid'),
				'destination'	=> $this->selected_page,
				'content'    	=> $this->value('answer'),
				'creator'    	=> $this->user->ID()
			);

			$this->Answer->Create($answer);
		}else{
			$this->fail();
		}

		header("Location: ".WEBROOT.'book/view/'.$this->value('book').'/'.$this->value('pageid'));
	}
}