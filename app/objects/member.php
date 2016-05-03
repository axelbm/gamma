<?php
namespace Apps\Object;

class Member{
	private $id;
	private $email;
	private $username;
	private $password;
	private $birtdate;
	private $country;
	private $registration_date;
	private $confirmed;
	private $confirmation_token;
	private $connection_token;

	// Methodes
	public function __construct($data){
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function ID(){
		return $this->id;
	}

	public function Email($email=null){
		if(isset($email) & !empty($email)){
			$this->email = $email;
		}

		return $this->email;
	}

	public function Username($username=null){
		if(isset($username) & !empty($username)){
			$this->username = $username;
		}

		return $this->username;
	}

	public function Password($password=null){
		if(isset($password) & !empty($password)){
			$this->password = $password;
		}

		return $this->password;
	}

	public function BirtDate($birtdate=null){
		if(isset($birtdate) & !empty($birtdate)){
			$this->birtdate = $birtdate;
		}

		return $this->birtdate;
	}

	public function Country($country=null){
		if(isset($country) & !empty($country)){
			$this->country = $country;
		}

		return $this->country;
	}

	public function RegistrationDate($registration_date=null){
		if(isset($registration_date) & !empty($registration_date)){
			$this->registration_date = $registration_date;
		}

		return $this->registration_date;
	}

	public function Confirmed($confirmed=null){
		if(isset($confirmed) & !empty($confirmed)){
			$this->confirmed = $confirmed;
		}

		return $this->confirmed;
	}

	public function ConfirmationToken($confirmation_token=null){
		if(isset($confirmation_token) & !empty($confirmation_token)){
			$this->confirmation_token = $confirmation_token;
		}

		return $this->confirmation_token;
	}

	public function ConnectionToken($connection_token=null){
		if(isset($connection_token) & !empty($connection_token)){
			$this->connection_token = $connection_token;
		}

		return $this->connection_token;
	}


	public function RemoveConnectionToken(){
		$this->connection_token = null;
	}

	public function CheckPassword($password, $encrypted=false){
		if(!$encrypted)
			$password = md5($password);

		if($this->Password() === $password)
			return true;

		return false;
	}

	public function ChangePassword($password){
		$pwd = md5($password);
		$this->Password($pwd);
	}

	public function Confirm(){
		$this->confirmed = 1;
		$this->confirmation_token = '';
	}

	public function HasAccess($obj){
		if(method_exists($obj, 'UserAccess')){
			$obj->UserAccess($this);
		}else{
			
		}
	}
}