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

	// function act_index(){

	// }

	// function act_news($page=null){

	// }

	// function act_top($page=null){

	// }

	// function act_category($category=null, $page=null){

	// }

	function act_view($bookid=null, $pageid=null){
		if(isset($bookid) & !empty($bookid)){
			$this->set(array('can_minimize'=>true));
			
			$book = $this->Book->GetByID($bookid);

			if(!isset($book) | empty($book)){
				Controller::weberror('404', 'La livre est introuvable.');
			}

			if(!empty($this->form)){
				if($this->form->id == 'page_answer' & isset($this->formresult) & !empty($this->formresult) ){
					$pageid = $this->formresult;
				}else{
					$pageid = $pageid?:$book['starting_page'];
				}
			}else{
				$pageid = $pageid?:$book['starting_page'];
			}

			$page = $this->Page->GetByID($pageid);

			if(empty($page)){
				Controller::weberror('404', 'La page est introuvable.');
			}

			$answers = $this->Answer->GetByPageID($pageid);

			$this->set('book',   	$book);
			$this->set('page',   	$page);
			$this->set('answers',	$answers);
			
			if(isset($_SESSION['previous_page']) & !empty($_SESSION['previous_page'])){
				$this->set('previous_page', $_SESSION['previous_page']);
			}

			
			$this->render();
		}else{
			$this->noaction();
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