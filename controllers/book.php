<?php
class book extends Controller{
	private $Book;
	private $Page;
	private $Answer;
	private $Link;

	function init(){
		$this->Book  	= $this->loadModel('book');
		$this->Page  	= $this->loadModel('page');
		$this->Answer	= $this->loadModel('answer');
		$this->Link  	= $this->loadModel('user_book');
	}

	// function act_index(){

	// }

	// function act_news($page=null){

	// }

	// function act_top($page=null){

	// }

	// function act_category($category=null, $page=null){

	// }

	function act_view($bookid=null){
		if(isset($bookid) & !empty($bookid)){
			$book = $this->Book->GetByID($bookid);

			if(!isset($book) | empty($book)){
				Controller::weberror('404', 'La livre est introuvable.');
			}

			$userid = $this->user ? $this->user->GetID() : 0;
			$link = $this->Link->GetLink($userid, $bookid);
			
			$this->Page->GetAuthors($bookid);

			$this->set('link', $link);
			$this->set('book', $book);
			$this->render();
		}else{
			$this->noaction();
		}
	}

	function act_read($bookid=null){
		if($this->user){
			if(isset($bookid) & !empty($bookid)){
				$book = $this->Book->GetByID($bookid);
				if(!isset($book) | empty($book))
					Controller::weberror('404', 'La livre est introuvable.');

				$link = $this->Link->GetLink($this->user->GetID(), $bookid);
				$progression = $link['progression'];

				$data = array();

				foreach ($progression as $key => $value) {
					$page = $this->Page->GetByID($value[1]);
					$answer = $this->Answer->GetByID($value[1]);
					array_push($data, array($page, $answer));
				}

				if(count($data) == 0){
					$pageid = $book['starting_page'];
				}else{
					$pageid = $data[count($data)-1][1]['destination'];
				}

				$page = $this->Page->GetByID($pageid);
				if(empty($page))
					Controller::weberror('404', 'La page est introuvable.');

				$answers = $this->Answer->GetByPageID($pageid);

				$this->set('previous',	$data);
				$this->set('book',    	$book);
				$this->set('page',    	$page);
				$this->set('answers', 	$answers);
				
				$this->render();
			}else{
				$this->noaction();
			}
		}else{
			Controller::weberror('500', 'Vous devez vous cconnecter pour acceder à cette page.');
		}
	}

	// function act_edit($id){

	// }

	function act_create(){
		if($this->user){
			$this->render();
		}else{
			Controller::weberror('500', 'Vous devez vous cconnecter pour acceder à cette page.');
		}
	}
}
?>