<?php
class home extends Controller{
	function index(){
		$Book = $this->loadModel('book');
		$Member = $this->loadModel('member');
		$data = $Book->find();

		foreach ($data as $key => $value) {
			$data[$key]['creator'] = $Member->GetByID($data[$key]['creator']);
		}
		
		$d = array('tab'=>$data);
		$this->set($d);
		$this->render();

	}
}
?>