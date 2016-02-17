<?php
class Member{

	// Methodes
	public function __construct($data){
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	public function SetUserName($username){
		$this->username = $username;
	}
	public function SetPassword($pwd){
		$this->password = $pwd;
	}
	public function SetBirtdate($birtdate){
		$this->birtdate = $birtdate;
	}
	public function SetCountry($country){
		$this->country = $country;
	}

	// Getter
	// public function GetID(){
	//	return $this->id;
	// }
	// public function GetUserName(){
	//	return $this->username;
	// }
	// public function GetEmail(){
	//	return $this->email;
	// }
	// public function GetPassword(){
	//	return $this->password;
	// }
	// public function GetBirtdate(){
	//	return $this->birtdate;
	// }
	// public function GetCountry(){
	//	return $this->country;
	// }
	// public function GetRegistrationDate(){
	//	return $this->registration_date;
	// }
	// public function IsConfirmed(){
	//	return $this->confirmed;
	// }
	// public function GetConfirmationToken(){
	//	return $this->confirmation_token;
	// }
	// public function GetConnectionToken(){
	//	return $this->connection_token;
	// }

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




	public function ChangePassword($password){
		$pwd = md5($password);
		$this->Password($pwd);
	}

	public function Confirm(){
		$this->confirmed = 1;
		$this->confirmation_token = '';
	}
}
?>