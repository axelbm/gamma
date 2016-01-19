<?php
class model_member extends Model{
	protected function load(){
		$this->setTable('member');
	}

	public function GetByID($id){
		$data = $this->find(array(
			'conditions' => 'id='.$id,
			'single' => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member($data);
			return $member;
		}
	}

	public function GetByToken($token){
		$data = $this->find(array(
			'conditions' => "confirmation_token='".$token."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member($data);
			return $member;
		}
	}

	public function GetByEmail($email){
		$data = $this->find(array(
			'conditions' => "email='".$email."'",
			'single'	 => true
		));

		if(empty($data)){
			return null;
		}else{
			$member = new Member($data);
			return $member;
		}
	}


	public function CreateAccout($data){
		if(!isset($data['email']) | empty($data['email']))
			return;
		if(!isset($data['password']) | empty($data['password']))
			return;

		$data['email'] = strtolower($data['email']);
		$data['confirmation_token'] = md5($data['email'].rand());
		$data['password'] = md5($data['password']);

		return $this->save($data);
	}
}