<?php
class home extends Controller{
	function index(){
		$Tutoriel = $this->loadModel('tutoriel');
		$data = array();
		$data['tab'] = $Tutoriel->find();
		
		// print_r($data['tab']);
		$this->set($data);
		$this->render();

	}
}
?>