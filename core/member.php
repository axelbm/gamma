<?php
class Member{
	private $id;
	private $nameid;
	private $name;
	private $email;

	// Methodes
	public function __construct($data){
		foreach ($data as $key => $value) {
			if(isset($this->$key)){
				$this->$key = $value;
			}
		}
		return $this;
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


}
?>