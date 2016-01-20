<?php
class page extends Controller{
	private $Book;
	private $Page;
	private $Answer;

	function init(){
		$this->Book  	= $this->loadModel('book');
		$this->Page  	= $this->loadModel('page');
		$this->Answer	= $this->loadModel('answer');
	}

	function act_add($id=null){
		if(isset($id) & !empty($id)){
			$page   	= $this->Page->GetByID($id);
			$book   	= $this->Book->GetByID($page['book']);
			$answers	= $this->Answer->GetByPageID($id);
			$pages  	= $this->Page->GetByBookID($page['book']);

			if(empty($page)){
				Controller::weberror('404', 'La page est introuvable.');
			}

			
			$this->set('page',   	$page);
			$this->set('pages',  	$pages);
			$this->set('book',   	$book);
			$this->set('answers',	$answers);
			$this->render();
		}else{
			$this->noaction();
		}
	}
}
?>