<?php
class book extends Controller{
	public $book;
	private $Book;
	private $Page;
	private $Answer;
	private $Link;
	private $Member;

	function init(){
		$this->Book  	= $this->loadModel('book');
		$this->Page  	= $this->loadModel('page');
		$this->Answer	= $this->loadModel('answer');
		$this->Link  	= $this->loadModel('user_book');
		$this->Member	= $this->loadModel('member');

		$this->book = $this->Book->GetByID($this->params[2]);
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
			if(!isset($this->book) | empty($this->book)){
				Controller::weberror('404', 'La livre est introuvable.');
			}

			$userid = $this->user ? $this->user->GetID() : 0;
			$link = $this->Link->GetLink($userid, $bookid);
			
			$contributor = $this->Page->GetAuthors($bookid);

			$usersname	= $this->Member->GetBasic(array_merge($contributor, array($this->book['creator'])));

			$this->set('pagescount', 	65);
			$this->set('link',       	$link);
			$this->set('book',       	$this->book);
			$this->set('contributor',	$contributor);
			$this->set('usersname',  	$usersname);
			$this->render();
		}else{
			$this->noaction();
		}
	}

	function act_read($bookid=null){
		if($this->user){
			if(isset($bookid) & !empty($bookid)){
				if(!isset($this->book) | empty($this->book))
					Controller::weberror('404', 'La livre est introuvable.');

				$link = $this->Link->GetLink($this->user->GetID(), $bookid);
				$progression = $link['progression'];

				$data = array();
				$u = array();

				foreach ($progression as $key => $value) {
					$page = $this->Page->GetByID($value[0]);
					$answer = $this->Answer->GetByID($value[1]);
					array_push($u, $page['creator']);
					array_push($u, $answer['creator']);
					array_push($data, array($page, $answer));
				}

				if(count($data) == 0){
					$pageid = $this->book['starting_page'];
				}else{
					$pageid = $data[count($data)-1][1]['destination'];
				}

				$page = $this->Page->GetByID($pageid);
				if(empty($page))
					Controller::weberror('404', 'La page est introuvable.');

				$answers = $this->Answer->GetByPageID($pageid);

				array_push($u, $this->book['creator']);
				array_push($u, $page['creator']);

				$usersname	= $this->Member->GetBasic($u);

				$this->set('previous', 	$data);
				$this->set('book',     	$this->book);
				$this->set('page',     	$page);
				$this->set('answers',  	$answers);
				$this->set('usersname',	$usersname);
				
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
			$Categories = $this->loadModel('categories');
			$categories = $Categories->GetAll('FR');

			$this->set('categories', $categories);
			$this->render();
		}else{
			Controller::weberror('500', 'Vous devez vous cconnecter pour acceder à cette page.');
		}
	}
}
?>