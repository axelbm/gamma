<?php
class form_user_change_password extends Form_New {
	private $user;

	protected function Init(){
		$this->DefaultObject(['password', 'new_password', 'new_password_conf']);

		$user = $this->Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->Fail();
		}
	}


	protected function check_password($obj){
		if($this->ValidString($obj)){
			if($this->user->CheckPassword($obj->Value())){
				$obj->Status(1);
				$obj->Valid();
			}else{
				$obj->Status(3);
				$obj->Message("Le mot de passe est invalide.");
			}
		}else{
			$obj->Status(3);
			$obj->Message("Mot de passe invalide.");
		}
	}

	protected function check_new_password($obj){
		if($this->ValidString($obj)){
			$password = $obj->Value();

			if(strlen($obj->Value()) < 6 or strlen($obj->Value()) > 16){
				$obj->Status(3);
				$obj->Message("Le mot de passe doit contenir entre 6 et 16 lettres.");
			}else{
				$obj->Status(1);
				$obj->Valid();
			}
		}else{
			$obj->Status(3);
			$obj->Message("Le mot de passe est obligatoir.");
		}
	}

	protected function check_new_password_conf($obj){
		if($this->ValidString($obj)){
			if($obj->Value() == $this->Value('new_password')){
				$obj->Status(1);
				$obj->Valid();
			}else{
				$obj->Status(3);
				$obj->Message("Les mots de passe ne correspondent pas.");
			}
		}else{
			$obj->Status(3);
			$obj->Message("Vous devez confirmer votre mot de passse.");
		}
	}

	protected function Failed(){
		$Controller = Controller::$self;
		$Controller->setjs('user_edit_tab', 'profil');
		$Controller->setjs('hash', 'change_pwd');
	}

	protected function Successful(){
		$this->user->ChangePassword($this->Value('new_password'));
		$this->Member->Update($this->user);

		$this->Object('password')->Value('');
		$this->Object('new_password')->Value('');
		$this->Object('new_password_conf')->Value('');
	}
}