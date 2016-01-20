<?php
class book extends Controller{
	private $Book;
	private $Page;
	private $Answer;

	function init(){
		$this->Book  	= $this->loadModel('book');
		$this->Page  	= $this->loadModel('page');
		$this->Answer	= $this->loadModel('answer');
	}

	function act_index(){

	}

	function act_news($page=null){

	}

	function act_top($page=null){

	}

	function act_category($category=null, $page=null){

	}

	function act_view($bookid=null, $pageid=null){
		if(isset($bookid) & !empty($bookid)){
			$book = $this->Book->GetByID($bookid);

			if(!isset($pageid) | empty($pageid)){
				if(!empty($this->form)){
					if($this->form->id == 'page_answer' & isset($this->formresult) & !empty($this->formresult) ){
						$pageid = $this->formresult;
					}else{
						$pageid = $book['starting_page'];
					}
				}else{
					$pageid = $book['starting_page'];
				}
			}

			$page = $this->Page->GetByID($pageid);

			if(empty($page)){
				Controller::weberror('404', 'La page est introuvable.');
			}

			$answers = $this->Answer->GetByPageID($pageid);

			$this->set('book',   	$book);
			$this->set('page',   	$page);
			$this->set('answers',	$answers);
			$this->render();
		}else{
			$this->noaction();
		}
	}

	function act_edit($id){

	}

	function act_create(){
		
	}
}
?>