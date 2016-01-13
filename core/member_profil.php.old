<?php
class Member_Profil{
	function __construct($data){
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$this->$key = $value;
			}
		}
	}

	function GetUserName(){
		return $this->username;
	}
	function GetFirstName(){
		return $this->firstname;
	}
	function GetLastName(){
		return $this->lastname;
	}
	function GetDescription(){
		return $this->description;
	}
	function GetBirthDate(){
		return $this->birtdate;
	}
	function GetCountry(){
		return $this->country;
	}
	function GetProvince(){
		return $this->province;
	}
	function GetCity(){
		return $this->city;
	}

	static function GetByNameID($nameid){
		global $Database;

		$data = Model::_find('member_profil', array(
			'conditions' => "nameid='".$nameid."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member_Profil($data);
			return $member;
		}
	}
}
?>