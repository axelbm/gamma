<?php
class form_signup extends Form{
	var $formfields = array('nameid', 'email', 'pwd', 'pwd_conf');

	function check_nameid($nameid){
		if(isset($nameid) & !empty($nameid)){
			if(strlen($nameid) >= 4 & strlen($nameid) <= 16){
				$check = Model::_find('member_account', array(
					"conditions"	=> "nameid='".$nameid."'",
					"single"    	=> true
				));

				if(!isset($check) | empty($check)){
					return true;
				}else{
					$this->error('L\'identifiant est déja utilisé.');
					return false;
				}
			}else{
				$this->error('L\'identifiant n\'est pas valide.');
				return false;
			}
		}else{
			$this->error('L\'identifiant est obligatoir.');
			return false;
		}
	}

	function check_email($email){
		if(isset($email) & !empty($email)){
			if(preg_match('/^[\w\.\-]*@\w*\.[\w\.]*$/', $email)){
				$check = Model::_find('member_account', array(
					"conditions"	=> "email='".$email."'",
					"single"    	=> true
				));

				if(!isset($check) | empty($check)){
					return true;
				}else{
					$this->error('L\'email est déja utilisé.');
					return false;
				}
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
			if(strlen($password) >= 6 & strlen($password) <= 16){
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

	function check_pwd_conf($passwordconf){
		if(isset($passwordconf) & !empty($passwordconf)){
			if($passwordconf == $this->value('pwd')){
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

	function success(){
		$account = array();

		$account['nameid'] = $this->value('nameid');
		$account['email'] = $this->value('email');
		$account['password'] = $this->value('pwd');

		$this->success = true;
		//Member_Account::CreateAccout($account);

		// header('Location: '.WEBROOT);
		// exit;
	}
}
?>