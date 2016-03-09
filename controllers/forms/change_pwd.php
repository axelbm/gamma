<?php
class form_change_pwd extends Form{
	var $formfields = array('pwd', 'new_pwd', 'new_pwd_conf');
	var $user;
	
	function init(){
		$Controller	= Controller::$self;
		$user      	= $Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			$this->fail();
		}
	}

	function check_pwd($pwd){
		if($this->user){
			if(isset($pwd) & !empty($pwd)){
				$pwd = md5($pwd);
				
				if($pwd == $this->user->Password()){
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

	function check_new_pwd($pwd){
		if(isset($pwd) & !empty($pwd)){
			if(strlen($pwd) >= 6 & strlen($pwd) <= 16){
				return true;
			}else{
				$this->error('Le mot de passe doit contenir entre 6 et 16 lettres.');
				return false;
			}
		}else{
			$this->error('Le mot de passe est obligatoir.');
			return false;
		}
	}

	function check_new_pwd_conf($pwd){
		if(isset($pwd) & !empty($pwd)){
			if($pwd == $this->value('new_pwd')){
				return true;
			}else{
				$this->error('Les mots de passe ne correspondent pas.');
				return false;
			}
		}else{
			$this->error('Vous devez confirmer votre mot de passse.');
			return false;
		}
	}

	function fail(){
		$Controller = Controller::$self;
		$Controller->setjs('user_edit_tab', 'profil');
		$Controller->setjs('hash', 'change_pwd');
	}

	function success(){
		$pwd = $this->value('new_pwd');
		$this->user->ChangePassword($pwd);
		$this->user->Save();

		$this->data = array();
		$this->formsuccess('Votre mot de passe a bien été changé.');
	}
}