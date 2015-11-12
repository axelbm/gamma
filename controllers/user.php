<?php
class user extends Controller{

	function index(){

	}

	function signup(){
		$this->render();
	}

	function login(){
		$this->render();
	}

	function edit($id){

	}

	function view($id=null){
		if(empty($id))
			Controller::weberror('404', 'L\'utilistaeur demandé est introuvable.');


		Member::GetByID($id);
	}
}
?>