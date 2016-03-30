<?php 
namespace Apps\Form\User;

class Edit extends \Gamma\Form {
	private $user;

	protected function Init(){
		$this->DefaultObject(['username', 'country', 'birtdate']);

		$user = $this->controller->User();

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->Fail();
		}
	}

	protected function check_username($obj){
		if($this->ValidString($obj)){
			$username = $obj->Value();

			if(strlen($username) >= 1 & strlen($username) <= 32){
				$obj->Status(1);
				$obj->Valid();
			}else{
				$obj->Status(3);
				$obj->Message('Le nom doit être entre 1 et 32 lettres');
			}
		}else{
			$obj->Valid();
		}
	}

	protected function check_country($obj){
		if($this->ValidString($obj)){
			$country_list = $this->Resource->Coutnries();

			if(array_key_exists($obj->Value(), $country_list)){
				$obj->Status(1);
				$obj->Valid();
			}else{
				$obj->Status(3);
				$obj->Message("Il y a une érreur dans la sélection du pays.");
			}
		}else{
			$obj->Valid();
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
			$obj->Valid();
		}
	}

	protected function Failed(){
		$this->controller->setjs('user_edit_tab', 'profil');
		$this->controller->setjs('hash', 'edit_profil');
	}

	protected function Successful(){
		if($this->ValidString('username'))
			$this->user->UserName($this->HTMLEscape('username'));

		if($this->ValidString('country'))
			$this->user->Country($this->Value('country'));

		if($this->ValidString('birtdate'))
			$this->user->Birtdate($this->Value('birtdate'));

		$this->Member->Update($this->user);

		$this->controller->setjs('user_edit_tab', 'profil');
		$this->controller->setjs('hash', 'edit_profil');
	}
}