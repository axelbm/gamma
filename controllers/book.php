<?php
class book extends Controller{
	public $book;

	function init(){

		if(isset($this->params[0]) & !empty($this->params[0])){
			$bookid = $this->params[0];
			if(is_numeric($bookid)){
				$this->book = $this->Book->GetByID($this->params[0]);
			}
		}
	}

	// function act_index(){

	// }

	// function act_news($page=null){

	// }

	// function act_top($page=null){

	// }

	// function act_category($category=null, $page=null){

	// }

	function act_view(){
		$bookid = $this->book['id'];

		if(isset($bookid) & !empty($bookid)){
			if(!isset($this->book) | empty($this->book)){
				Controller::weberror('404', 'La livre est introuvable.');
			}

			$userid	= $this->user ? $this->user->GetID() : 0;
			$link  	= $this->User_book->GetLink($userid, $bookid);
			
			$contributor	= $this->Page->GetAuthors($bookid);
			array_push($contributor, $this->book['creator']);
			$contributor	= array_unique($contributor);

			$usersname     	= $this->Member->GetBasic(array_merge($contributor, array($this->book['creator'])));
			$pagecount     	= $this->Page->Count($bookid);
			$stats         	= $this->User_book->GetStats($bookid);
			$stats['rate'] 	= round($stats['likerate']*100, 2);
			$stats['stars']	= round($stats['likerate']*5);

			$category = $this->Categories->GetByID($this->book['category'], 'FR');

			$this->set('book_category',	$category);
			$this->set('stats',        	$stats);
			$this->set('pagescount',   	$pagecount);
			$this->set('link',         	$link);
			$this->set('book',         	$this->book);
			$this->set('contributor',  	$contributor);
			$this->set('usersname',    	$usersname);
			$this->render();
		}else{
			$this->noaction();
		}
	}

	function act_read(){
		$bookid = $this->book['id'];

		if($this->user){
			if(isset($bookid) & !empty($bookid)){
				if(!isset($this->book) | empty($this->book))
					Controller::weberror('404', 'La livre est introuvable.');

				$link = $this->User_book->GetLink($this->user->GetID(), $bookid);
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

	function act_edit($id){
		$bookid = $this->book['id'];

		if($this->user){
			if(isset($bookid) & !empty($bookid)){

				$pages  	= $this->Page->GetByBookID($bookid) ?: array();
				$answers	= $this->Answer->GetByBookID($bookid) ?: array();
				$categories = $this->Categories->GetAll('FR') ?: array();

				$pages_title = array();

				foreach ($pages as $key => $page) {
					$pages_title[$page['id']] = $page['title']?:'Page '.$page['id'];
				}

				$u = array($this->book['creator']);
				foreach ($pages  	as $key => $p) { array_push($u, $p['creator']); }
				foreach ($answers	as $key => $a) { array_push($u, $a['creator']); }

				$usersname	= $this->Member->GetBasic($u);

				$this->set('pages_title',	$pages_title);
				$this->set('book',       	$this->book);
				$this->set('pages',      	$pages);
				$this->set('answers',    	$answers);
				$this->set('usersname',  	$usersname);
				$this->set('categories', 	$categories);

				$this->render();
			}else{
				$this->noaction();
			}
		}else{
			Controller::weberror('500', 'Vous devez vous cconnecter pour acceder à cette page.');
		}
	}

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