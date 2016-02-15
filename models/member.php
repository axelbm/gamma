<?php
class model_member extends Model{
	protected function load(){
		$this->setTable('member');
	}

	public function GetBasic($ids=array()){
		$data = $this->find(array(
			'fields' => 'id, username',
			'conditions' => 'id IN ('.implode(', ', $ids).')'
		));

		$users = array();
		if(!empty($data)){
			foreach ($data as $key => $value) {
				$users[$value['id']] = $value['username'];
			}
		}
		
		return $users;
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

	public function GetByConnectionToken($token){
		$data = $this->find(array(
			'conditions' => "connection_token='".$token."'",
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

	public function Update($user){
		$data = array(
			'username'          	=> $user->GetUserName(),
			'email'             	=> $user->GetEmail(),
			'password'          	=> $user->GetPassword(),
			'birtdate'          	=> $user->GetPassword(),
			'country'           	=> $user->GetCountry(),
			'confirmed'         	=> $user->IsConfirmed(),
			'confirmation_token'	=> $user->GetConfirmationToken(),
			'connection_token'  	=> $user->GetConnectionToken()
		);

		$this->save($user->GetID(), $data);
	}

	public function AutoReconnect($user){
		$token = md5(uniqid($user->GetID(), true));
		$user->connection_token = $token;

		setcookie('connection_token', $token);

		$this->Update($user);
	}
}