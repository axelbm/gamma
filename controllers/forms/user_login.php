<?php
class form_user_login extends Form_New{
	protected function Init(){
		$this->DefaultObject(['email', 'password', 'remember']);

		$user = $this->Controller->user;
		if(!empty($user))
			$this->Fail();
	}

	protected function check_email($obj){
		if($this->IsEmail($obj)){
			$obj->Status(1);
			$obj->Message("Valid Email");
			$obj->Valid();
		}else{
			$obj->Status(3);
			$obj->Message("Veuillez entrer votre courriel.");
		}
	}

	protected function check_password($obj){
		if($this->ValidString($obj)){
			$obj->Status(1);
			$obj->Message("Valid Password");
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
		$user = $this->Member->GetByEmail($this->Object('email')->Value());

		if($user){
			$password = $this->Object('password')->Value();

			if($user->CheckPassword($password)){
				$this->Controller->UserLogin($user);

				if($this->Object('remember')->Value()){
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