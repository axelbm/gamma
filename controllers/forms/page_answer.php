<?php
class form_page_answer extends Form{
	var $formfields = array('page', 'book', 'answer');
	private $page;
	
	function check_answer($answer){
		if(isset($answer) & !empty($answer)){
			$Controller = Controller::$self;
			$Page = $Controller->loadModel('page');

			$answer = intval($answer);

			$page = $Page->GetByID($answer);

			if(!empty($page)){
				$this->page = $page;
				return true;
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
		// $this->result = $id;
		$_SESSION['previous_page'] = $pageid;
		header('Location: '.WEBROOT.'book/view/'.$bookid.'/'.$id);
	}
}