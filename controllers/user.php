<?php
class user extends Controller{
	function start(){

	}

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
		if(isset($_SESSION['success_userid']) & !empty($_SESSION['success_userid'])){
			$id = $_SESSION['success_userid'];

			if(isset($id) & !empty($id)){
				$Member = $this->loadModel('member');
				$user = $Member->GetByID($id);

				if(empty($user))
					Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');


				$data = array('user'=>$user);
				$this->set($data);

				$this->render();
			}else{
				Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
			}
		}else{
			Controller::weberror('404', '');
		}
	}

	function confirm($token){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		$Member = $this->loadModel('member');
		$user = $Member->GetByToken($token);

		if(empty($user))
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');

		if(!$user->IsConfirmed()){
			$user->Confirm();

			$d = array('user' => $user, 'success' => true);

			$this->set($d);
			$this->render();
		}else{
			Controller::weberror('404', 'Votre compte a déjà été confirmé.');
		}

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
				$id = $this->user->GetID();
			}elseif($id != $this->user->GetID()){
				Controller::weberror('404', 'La page est invalide.');
			}

			$Member = $this->loadModel('member');
			$user = $Member->GetByID($id);
			$d = array('user' => $user);

			$this->set($d);
			$this->render();
		}else{
			Controller::weberror('404', 'La page est invalide.');
		}
	}

	function profil($id=null){
		if(empty($id)){
			if(!empty($this->user)){
				$id = $this->user->GetID();
			}else{
				Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
			}
		}

		$Member = $this->loadModel('member');
		$user = $Member->GetByID($id);

		if(!$user){
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
		}

		$data = array('member'=>$user);
		
		// $this->setTitle(Site_Name.' - '.$member->getName());
		$this->set($data);
		$this->render('');
	}
}
?>