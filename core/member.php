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
	public function GetID(){
		return $this->id;
	}
	public function GetUserName(){
		return $this->username;
	}
	public function GetEmail(){
		return $this->email;
	}
	public function GetPassword(){
		return $this->password;
	}
	public function GetBirtdate(){
		return $this->birtdate;
	}
	public function GetCountry(){
		return $this->country;
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
	public function GetConnectionToken(){
		return $this->connection_token;
	}


	public function Confirm(){
		$this->confirmed = 1;
		$this->confirmation_token = '';
		
		// $this->Save();
	}

	// public function Save(){
	//	$data = array(
	//		'username'          	=> $this->GetUserName(),
	//		'email'             	=> $this->GetEmail(),
	//		'password'          	=> $this->GetPassword(),
	//		'birtdate'          	=> $this->GetPassword(),
	//		'country'           	=> $this->GetCountry(),
	//		'confirmed'         	=> $this->IsConfirmed(),
	//		'confirmation_token'	=> $this->GetConfirmationToken()
	//	);

	//	$Controller = Controller::$self;
	//	$Controller->Member->save($this->GetID(), $data);
	// }

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


	// static function GetByID($id){
	//	global $Database;

	//	$sql = "SELECT * FROM member WHERE id='$id'";
	//	$req = $Database->query($sql);
	//	$data = $req->fetch(PDO::FETCH_ASSOC);

	//	if(empty($data)){
	//		return null;
	//	}else{
	//		$member = new Member($data);
	//		return $member;
	//	}
	// }

	// static function GetByToken($token){
	//	global $Database;

	//	$data = Model::_find('member', array(
	//		'conditions' => "confirmation_token='".$token."'",
	//		'single'	 => true
	//	));

	//	if(empty($data)){
	//		return null;
	//	}else{
	//		$member = new Member($data);
	//		return $member;
	//	}
	// }

	// static function GetByEmail($email){
	//	global $Database;

	//	$data = Model::_find('member', array(
	//		'conditions' => "email='".$email."'",
	//		'single'	 => true
	//	));

	//	if(empty($data)){
	//		return null;
	//	}else{
	//		$member = new Member($data);
	//		return $member;
	//	}
	// }


	// static function CreateAccout($data){
	//	if(!isset($data['email']) | empty($data['email']))
	//		return;
	//	if(!isset($data['password']) | empty($data['password']))
	//		return;

	//	$data['email'] = strtolower($data['email']);
	//	$data['confirmation_token'] = md5($data['email'].rand());
	//	$data['password'] = md5($data['password']);

	//	return Model::_save('member', $data);
	// }
}
?>