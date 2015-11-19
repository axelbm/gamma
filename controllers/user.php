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
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');

		$member = Member::GetByNameID($id);

		if(!$member){
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
		}

		$data = array('user'=>$member);
		
		$this->setTitle(Site_Name.' - '.$member->getName());
		$this->set($data);
		$this->render();
	}
}
?>