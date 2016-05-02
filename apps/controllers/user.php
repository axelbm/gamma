<?php
namespace Apps\Controller;

class User extends \Apps\Controller{

	function Init(){
		
	}

	function act_signup(){
		if($this->User()){
			header('Location: '.WEBROOT);
			exit;
		}

		$country_list = $this->Resource->Countries();
		
		$this->set("country_list", $country_list);
		$this->render();
	
	}

	function act_success(){
		if(isset($_SESSION['success_userid']) & !empty($_SESSION['success_userid'])){
			$id = $_SESSION['success_userid'];

			if(isset($id) & !empty($id)){
				$user = $this->Member->GetByID($id);

				if(empty($user))
					die('L\'utilisateur demandé est introuvable.');


				$data = array('member'=>$user);
				$this->set($data);

				$this->render();
			}else{
				header('Location: '.WEBROOT);
				exit;
			}
		}else{
			header('Location: '.WEBROOT);
			exit;
		}
	}

	function act_confirm($token){
		if($this->user)
			Controller::weberror('404', 'La page est invalide.');

		$user = $this->Member->GetByToken($token);

		if(empty($user)){
			header('Location: '.WEBROOT);
			exit;
		}

		if(!$user->Confirmed()){
			$user->Confirm();
			$this->Member->Update($user);

			$d = array('member' => $user, 'success' => true);

			$this->set($d);
			$this->render();
		}else{
			header('Location: '.WEBROOT);
			exit;
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
			$country_list = $this->Resource->Countries();
			
			$this->set("country_list", $country_list);
			$this->render();
		}else{
			header('Location: '.WEBROOT);
			exit;
		}
	}

	function act_profil($id=null){
		$user = null;

		if(empty($id)){
			if(!empty($this->user)){
				$user = $this->user;
			}else{
				header('Location: '.WEBROOT);
				exit;
			}
		}
		else{
			$user = $this->Member->GetByID($id);
		}

		if(!$user){
			header('Location: '.WEBROOT);
			exit;
		}

		$data = array('member'=>$user);
		
		// $this->setTitle(Site_Name.' - '.$member->getName());
		$this->set($data);
		$this->render();
	}
}