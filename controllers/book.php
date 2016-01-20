<?php
class book extends Controller{
	private $Book;
	private $Page;
	private $Answer;

	function init(){
		$this->Book = $this->loadModel('book');
		$this->Page = $this->loadModel('page');
		$this->Answer = $this->loadModel('answer');
	}

	function act_index(){

	}

	function act_news($page=null){

	}

	function act_top($page=null){

	}

	function act_category($category=null, $page=null){

	}

	function act_view($bookid, $pageid=null){
		$book = $this->Book->GetByID($bookid);

		if(!isset($pageid) | empty($pageid)){
			$pageid = $book['starting_page'];
		}

		$page = $this->Page->GetByID($pageid);

		if(empty($page)){
			Controller::weberror('404', 'La page est introuvable.');
		}else{
			$this->set('page', $page);
		}

		$answers = $this->Answer->GetByPageID($pageid);
		$this->set('answers', $answers);

		$this->set('book', $book);
		$this->render();
	}

	function act_edit($id){

	}

	function act_create(){
		
	}
}
?>