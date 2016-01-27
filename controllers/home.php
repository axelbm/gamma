<?php
class home extends Controller{
	function act_index(){
		$Book = $this->loadModel('book');
		$Member = $this->loadModel('member');
		$data = $Book->find();

		$getcreator = function($book){
			return $book['creator'];
		};

		$ids = array_unique(array_map($getcreator, $data));
		$usersname = $Member->GetBasic($ids);
		
		$this->set('books', $data);
		$this->set('usersname', $usersname);
		$this->render();
	}
}
?>