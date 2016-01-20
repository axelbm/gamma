<?php
class home extends Controller{
	function act_index(){
		$Book = $this->loadModel('book');
		$Member = $this->loadModel('member');
		$data = $Book->find();

		foreach ($data as $key => $value) {
			$data[$key]['creator'] = $Member->GetByID($data[$key]['creator']);
		}
		
		$this->set('books', $data);
		$this->render();

	}
}
?>