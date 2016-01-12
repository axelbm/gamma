<?php
class form_login extends Form{
	var $formfields = array('email', 'pwd', 'remember');
	var $account;
	var $password;

	function check_email($email){
		if(isset($email) & !empty($email)){
			if(preg_match('/^[\w\.\-]*@\w*\.[\w\.]*$/', $email)){
				return true;
			}else{
				$this->error('L\'email n\'est pas valide.');
				return false;
			}
		}else{
			$this->error('L\'email est obligatoir.');
			return false;
		}
	}

	function check_pwd($password){
		if(isset($password) & !empty($password)){
			return true;
		}else{
			$this->error('Le mot de passe est obligatoir.');
			return false;
		}
	}

	function check_remember($remember){
		$value = $this->get('remember');
		if(isset($value)){
			return true;
		}else{
			$this->error('error');
			return false;
		}
	}

	function success(){
		$account       	= Member_Account::GetByEmail($this->get('email')['value']);
		$this->account 	= $account;
		$password      	= md5($this->get('pwd')['value']);
		$this->password	= $password;

		if(!empty($account)){
			if($account->GetPassword() == $password){
				$Controller = Controller::$self;
				$Controller->UserLogin($account);
				header('Location: '.WEBROOT);
			}
		}

		$this->formerror('Le email ou le mot de pass est invalide.');
		$this->fail();
	}
}
?>