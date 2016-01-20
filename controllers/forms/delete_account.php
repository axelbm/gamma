<?php
class form_delete_account extends Form{
	var $formfields = array('id', 'pwd', 'confirm');
	var $user;

	function check_id($id){
		if(isset($id) & !empty($id)){
			$Controller = Controller::$self;
			$Member = $Controller->loadModel('member');
			$user = $Member->GetByID($id);

			if(!empty($user)){
				$this->user = $user;
				return true;
			}else{
				$this->formerror('L\'utilisateur est introuvable.');
				return false;
			}
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			return false;
		}
	}

	function check_pwd($pwd){
		if($this->user){
			if(isset($pwd) & !empty($pwd)){
				$pwd = md5($pwd);
				
				if($pwd == $this->user->GetPassword()){
					return true;
				}else{
					$this->error('Le mot de passe est invalide.');
					return false;
				}
			}else{
				$this->error('Le mot de passe est invalide.');
				return false;
			}
		}else{
			$this->error('error');
			return false;
		}
	}

	function check_confirm($confirm){
		if($confirm == 'on'){
			return true;
		}else{
			$this->formerror('Vous devez confirmer pour supprimer votre compte.');
			return false;
		}
	}

	function fail(){
		$Controller = Controller::$self;
		$Controller->setjs('user_edit_tab', 'security');
		$Controller->setjs('delete_account_modal', true);
	}

	function success(){
		unset($_SESSION['user_id']);
		header('Location: '.WEBROOT);
	}
}