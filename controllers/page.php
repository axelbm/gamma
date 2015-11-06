<?php
class page extends Controller{
	function index(){
		$Tutoriel = $this->loadModel('Tutoriel');
		$data = array();
		$data['tab'] = $Tutoriel->find();
		
		$this->set($data);
		$this->render('index');
	}
}
?>