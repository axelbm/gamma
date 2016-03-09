<?php
class controller_home extends Controller{
	function act_index(){
		$count = 5;

		$offset	= isset($_GET['p'])&!empty($_GET['p'])?$_GET['p']:0;
		$books 	= $this->Book->GetList($count, $offset)?:array();

		$categories = $this->Categories->GetAll('FR');

		$getcreator = function($book){
			return $book->Creator();
		};

		$ids = array();
		if(!empty($books)){
			$ids	= array_unique(array_map($getcreator, $books));
		}
		$usersname	= $this->Member->GetBasic($ids);

		$next = $offset-$count>=0 ? $offset-$count : -1;
		$previous = $this->Book->GetList(1, $offset+$count)? $offset+$count : -1;

		$this->set('offset',    	$offset);
		$this->set('next',      	$next);
		$this->set('previous',  	$previous);
		$this->set('categories',	$categories);
		$this->set('books',     	$books);
		$this->set('usersname', 	$usersname);
		$this->render();
	}

	function act_test(){
		$this->render();
	}
}
?>