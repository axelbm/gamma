<?php
class home extends Controller{
	function act_index(){
		$data	= $this->Book->find();

		$categories = $this->Categories->GetAll('FR');

		$getcreator = function($book){
			return $book['creator'];
		};

		$ids      	= array_unique(array_map($getcreator, $data));
		$usersname	= $this->Member->GetBasic($ids);
		
		$this->set('categories',	$categories);
		$this->set('books',     	$data);
		$this->set('usersname', 	$usersname);
		$this->render();
	}
}
?>