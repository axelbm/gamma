<?php
namespace Apps\Form\User;

class Signup extends \Gamma\Form{
	protected function Init(){
		$this->DefaultObject(['username', 'email', 'password', 'password_conf', 'country', 'birtdate', 'aggre']);

		$user = $this->controller->User();

		if(!empty($user)){
			$this->Fail();
		}
	}

	protected function check_username($obj){
		if($this->ValidString($obj)){
			$username = $obj->Value();

			if(strlen($username) < 1 or strlen($username) > 32){
				$obj->Status(3);
				$obj->Message("Le nom doit être entre 1 et 32 lettres");
			}else{
				$obj->Status(1);
				$obj->Valid();
			}
		}else{
			$obj->Status(3);
			$obj->Message("Vous devez entrer un nom.");
		}
	}

	protected function check_email($obj){
		if($this->IsEmail($obj)){
			$account = $this->Member->GetByEmail($obj->Value());

			if($account){
				$obj->Status(3);
				$obj->Message("L'email est déja utilisé.");
			}else{
				$obj->Status(1);
				$obj->Valid();
			}
		}else{
			$obj->Status(3);
			$obj->Message("Veuillez entrer votre courriel.");
		}
	}

	protected function check_password($obj){
		if($this->ValidString($obj)){
			$password = $obj->Value();

			if(strlen($password) < 6 or strlen($password) > 16){
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

	protected function check_password_conf($obj){
		if($this->ValidString($obj)){
			if($obj->Value() == $this->Value('password')){
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

	protected function check_country($obj){
		if($this->ValidString($obj)){
			$country_list = $this->Resource->Countries();

			if(array_key_exists($obj->Value(), $country_list)){
				$obj->Status(1);
				$obj->Valid();
			}else{
				$obj->Status(3);
				$obj->Message("Il y a une érreur dans la sélection du pays.");
			}
		}else{
			$obj->Status(3);
			$obj->Message('Vous devez sélectionner votre pays.');
		}
	}

	protected function check_birtdate($obj){
		if($this->ValidString($obj)){
			if(preg_match('/^[\d]{4}-[\d]{2}-[\d]{2}$/', $obj->Value())){
				$obj->Status(1);
				$obj->Valid();
			}else{
				$obj->Status(3);
				$obj->Message("La date est invalide. (aaaa-mm-jj)");
			}
		}else{
			$obj->Status(3);
			$obj->Message('Vous devez entrer votre date de naissence.');
		}
	}

	protected function check_aggre($obj){
		if($this->ValidString($obj)){
			$obj->Status(1);
			$obj->Valid();
		}else{
			$obj->Status(3);
			$obj->Message('Vous devez accepter les condition d\'utilisateur.');
		}
	}

	protected function Successful(){
		$account = array();

		$account['email']   	= $this->Value('email');
		$account['username']	= $this->HTMLEscape('username');
		$account['password']	= $this->Value('password');
		$account['country'] 	= $this->Value('country');
		$account['birtdate']	= $this->Value('birtdate');

		$id = $this->Member->CreateAccout($account);

		if(isset($id) & !empty($id)){
			$_SESSION['success_userid'] = $id;

			header('Location: '.WEBROOT.'user/success');
			exit;
		}
	}
}