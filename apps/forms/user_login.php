<?php
namespace Apps\Form;

class User_login extends \Gamma\Form{
	protected function Init(){
		$this->DefaultObject(['email', 'password', 'remember']);

		$user = $this->Controller->user;
		if(!empty($user))
			$this->Fail();
	}

	protected function check_email($obj){
		if($this->IsEmail($obj)){
			$obj->Status(1);
			$obj->Valid();
		}else{
			$obj->Status(3);
			$obj->Message("Veuillez entrer votre courriel.");
		}
	}

	protected function check_password($obj){
		if($this->ValidString($obj)){
			$obj->Status(1);
			$obj->Valid();
		}else{
			$obj->Status(3);
			$obj->Message("Mot de passe invalide.");
		}
	}

	protected function Failed(){
		$this->Controller->setjs('connection_modal', true);
	}

	protected function Successful(){
		$user = $this->Member->GetByEmail($this->Value('email'));

		if($user){
			$password = $this->Value('password');

			if($user->CheckPassword($password)){
				$this->Controller->UserLogin($user);

				if($this->Value('remember')){
					$this->Object('remember')->Status(1);
					$this->Member->AutoReconnect($user);
				}

				header("Location: " . $_SERVER['REQUEST_URI']);
				exit;
			}else{
				$this->Object('email')->Status(3);
				$this->Object('email')->Message('Les informations ne correspondent pas.');

				$this->Object('password')->Rebuild(null, null, 3);

				$this->Failed();
			}
		}else{
			$this->Object('email')->Status(3);
			$this->Object('email')->Message('Le courriel est invalid.');

			$this->Object('password')->Clean();

			$this->Failed();
		}
	}
}