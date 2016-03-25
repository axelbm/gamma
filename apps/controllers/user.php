<?php
namespace Apps\Controller;

class User extends \Apps\Controller{

	function init(){
		
	}

	function act_signup($message=null){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		if($message == 'success'){
			echo 'heyyy';
		}else{
			$this->render();
		}
	}

	function act_success(){
		if(isset($_SESSION['success_userid']) & !empty($_SESSION['success_userid'])){
			$id = $_SESSION['success_userid'];

			if(isset($id) & !empty($id)){
				$user = $this->Member->GetByID($id);

				if(empty($user))
					Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');


				$data = array('member'=>$user);
				$this->set($data);

				$this->render();
			}else{
				Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
			}
		}else{
			Controller::weberror('404', '');
		}
	}

	function act_confirm($token){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		$user = $this->Member->GetByToken($token);

		if(empty($user))
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');

		if(!$user->Confirmed()){
			$user->Confirm();
			$this->Member->Update($user);

			$d = array('member' => $user, 'success' => true);

			$this->set($d);
			$this->render();
		}else{
			Controller::weberror('404', 'Votre compte a déjà été confirmé.');
		}

	}

	function act_logout(){
		if($this->user){
			$this->user->RemoveConnectionToken();
			$this->Member->Update($this->user);
			setcookie('connection_token', null, -1, '/');

			unset($_SESSION['user_id']);
		}
		header('Location: '.WEBROOT);
	}

	function act_edit(){
		if($this->user){
			$this->render();
		}else{
			Controller::weberror('404', 'La page est invalide.');
		}
	}

	function act_profil($id=null){
		$user = null;

		if(empty($id)){
			if(!empty($this->user)){
				$user = $this->user;
			}else{
				Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
			}
		}
		else{
			$user = $this->Member->GetByID($id);
		}

		if(!$user){
			Controller::weberror('404', 'L\'utilisateur demandé est introuvable.');
		}

		$data = array('member'=>$user);
		
		// $this->setTitle(Site_Name.' - '.$member->getName());
		$this->set($data);
		$this->render();
	}
}
?>