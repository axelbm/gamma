<?php
namespace Apps\Form\Old;

class form_login extends \Gamma\Old\Form{
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

	function fail(){
		$Controller = Controller::$self;
		$Controller->setjs('connection_modal', true);
	}

	function success(){
		$Controller = Controller::$self;
		$Member = $Controller->loadModel('member');

		$account       	= $Member->GetByEmail($this->get('email')['value']);
		$this->account 	= $account;
		$password      	= md5($this->get('pwd')['value']);
		$this->password	= $password;

		if(!empty($account)){
			if($account->Confirmed()){
				if($account->Password() == $password){
					$this->Controller->UserLogin($account);

					if($this->value('remember')){
						$this->Member->AutoReconnect($account);
					}

					header("Location: " . $_SERVER['REQUEST_URI']);
					exit;
				}
			}
		}

		$this->formerror('Le email ou le mot de pass est invalide.');
		$this->fail();
	}
}
?>