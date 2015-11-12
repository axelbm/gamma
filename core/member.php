<?php
class Member{
	private $id;
	private $nameid;
	private $name;
	private $email;
	private $birthdate;

	// Methodes
	public function __construct(){

	}

	private function LoadFromTable($data){
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	// Getter
	public function GetID(){
		return $this->id;
	}
	public function GetName(){
		return $this->name;
	}
	public function GetNameID(){
		return $this->nameid;
	}
	public function GetEmail(){
		return $this->email;
	}

	// Setter
	public function SetName($name){
		$this->name = $name;
	}
	public function SetEmail($email){
		$this->email = $email;
	}


	static function GetByID($id){
		global $Database;

		$sql = "SELECT nameid, name, email, birthdate FROM member WHERE $id";
		$req = $Database->query($sql);
		$data = $req->fetch(PDO::FETCH_ASSOC);

		$member = new Member;
		$member->LoadFromTable($data);
		print_r($member);
	}
}
?>