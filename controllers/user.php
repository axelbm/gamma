<?php
class user extends Controller{

	function index(){

	}

	function signup($message=null){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		if($message == 'success'){
			echo 'heyyy';
		}else{
			$this->render();
		}
	}

	function success(){
		$this->render();
	}

	function confirm($token){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		$account = Member_Account::GetByToken($token);

		if(empty($account))
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');

		$d = array('account' => $account);

		$this->set($d);
		$this->render();
	}

	function login(){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		$this->render();
	}

	function logout(){
		unset($_SESSION['user_id']);
		header('Location: '.WEBROOT);
	}

	function edit($id=null){
		if($this->user){
			if(empty($id)){
				$id = $this->user->GetNameID();
			}elseif($id != $this->user->GetNameID()){
				Controller::weberror('404', 'La page est invalide.');
			}

			$this->render();
		}else{
			Controller::weberror('404', 'La page est invalide.');
		}
	}

	function profil($id=null){
		if(empty($id)){
			if(!empty($this->user)){
				$id = $this->user->GetNameID();
			}else{
				Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
			}
		}

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