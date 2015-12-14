<?php
class user extends Controller{

	function index(){

	}

	function signup(){
		$this->render();
	}

	function success(){
		$this->render();
	}

	function confirm($token){
		$account = Member_Account::GetByToken($token);

		if(empty($account))
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');

		$d = array('account' => $account);

		$this->set($d);
		$this->render();
	}

	function login(){
		$this->render();
	}

	function logout(){
		unset($_SESSION['user_id']);
		header('Location: '.WEBROOT);
	}

	function edit($id){

	}

	function profil($id=null){
		if(empty($id))
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');

		$member = Member_Account::GetByNameID($id);

		if(!$member){
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
		}

		$data = array('user'=>$member);
		
		// $this->setTitle(Site_Name.' - '.$member->getName());
		$this->set($data);
		$this->render('');
	}
}
?>