<?php
class home extends Controller{
	function index(){
		$d = array();
		$d['site'] = array(
			'title' => 'Gamma',
			'text' => 'HelloWorld',
		);
		
		$this->set($d);
		$this->render('index');
	}
}
?>