<?php
class Member_Account{
	// Methodes
	public function __construct(){

	}

	private function LoadFromTable($data){
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	// Getter
	public function GetID(){
		return $this->id;
	}
	public function GetNameID(){
		return $this->nameid;
	}
	public function GetEmail(){
		return $this->email;
	}
	public function GetPassword(){
		return $this->password;
	}
	public function GetRegistrationDate(){
		return $this->registration_date;
	}
	public function IsConfirmed(){
		return $this->confirmed;
	}
	public function GetConfirmationToken(){
		return $this->confirmation_token;
	}

	// public function Login(){
	//	$_SESSION['user_id'] = $this->id;

	// }

	// Setter
	// public function SetName($name){
	//	$this->name = $name;
	// }
	// public function SetEmail($email){
	//	$this->email = $email;
	// }


	static function GetByID($id){
		global $Database;

		$sql = "SELECT * FROM member_account WHERE id='$id'";
		$req = $Database->query($sql);
		$data = $req->fetch(PDO::FETCH_ASSOC);

		if(empty($data)){
			return null;
		}else{
			$member = new Member_Account;
			$member->LoadFromTable($data);
			return $member;
		}
	}

	static function GetByNameID($nameid){
		global $Database;

		$data = Model::_find('member_account', array(
			'conditions' => "nameid='".$nameid."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member_Account;
			$member->LoadFromTable($data);
			return $member;
		}
	}

	static function GetByToken($token){
		global $Database;

		$data = Model::_find('member_account', array(
			'conditions' => "confirmation_token='".$token."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member_Account;
			$member->LoadFromTable($data);
			return $member;
		}
	}

	static function GetByEmail($email){
		global $Database;

		$data = Model::_find('member_account', array(
			'conditions' => "email='".$email."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member_Account;
			$member->LoadFromTable($data);
			return $member;
		}
	}


	static function CreateAccout($data){
		if(!isset($data['nameid']) | empty($data['nameid']))
			return;
		if(!isset($data['email']) | empty($data['email']))
			return;
		if(!isset($data['password']) | empty($data['password']))
			return;

		$data['nameid'] = strtolower($data['nameid']);
		$data['email'] = strtolower($data['email']);
		$data['confirmation_token'] = md5($data['nameid'].rand());
		$data['password'] = md5($data['password']);

		echo Util::SublimTab($data);

		Model::_save('member_account', $data);
	}
}
?>