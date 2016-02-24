<?php
class model_member extends Model{
	static private $_members = array();
	
	protected function load(){
		$this->setTable('members');
	}

	protected function InitTable(){
		$this->run("
			CREATE TABLE IF NOT EXISTS `members` (
				`id`                	int(11)    	NOT NULL AUTO_INCREMENT, 
				`email`             	varchar(64)	NOT NULL, 
				`username`          	varchar(32)	NOT NULL, 
				`password`          	varchar(32)	NOT NULL, 
				`birtdate`          	date       	NOT NULL, 
				`country`           	varchar(2) 	NOT NULL, 
				`registration_date` 	timestamp  	NOT NULL DEFAULT CURRENT_TIMESTAMP, 
				`confirmed`         	tinyint(1) 	NOT NULL DEFAULT '0', 
				`confirmation_token`	varchar(32), 
				`connection_token`  	varchar(32), 

				UNIQUE (`id`, `email`), 
				PRIMARY KEY (`id`)
			); 

			CREATE UNIQUE INDEX `User_Id` ON members (`id`); 
		");

		// $this->createTable("member",
		//	array(
		//		array('name'=>'id',                	'type'=>'int',      	'size'=>11,	'notnull'=>true, 'autoinc'=>true, ''),
		//		array('name'=>'email',             	'type'=>'varchar',  	'size'=>64,	'notnull'=>true),
		//		array('name'=>'username',          	'type'=>'varchar',  	'size'=>32,	'notnull'=>true),
		//		array('name'=>'password',          	'type'=>'varchar',  	'size'=>32,	'notnull'=>true),
		//		array('name'=>'birtdate',          	'type'=>'date',     	'notnull'=>true),
		//		array('name'=>'country',           	'type'=>'varchar',  	'size'=>2,	'notnull'=>true),
		//		array('name'=>'registration_date', 	'type'=>'timestamp',	'notnull'=>true, 'default'=>'CURRENT_TIMESTAMP'),
		//		array('name'=>'confirmed',         	'type'=>'tinyint',  	'size'=>1,	'notnull'=>true, 'default'=>"'0'"),
		//		array('name'=>'confirmation_token',	'type'=>'varchar',  	'size'=>32),
		//		array('name'=>'connection_token',  	'type'=>'varchar',  	'size'=>32)
		//	),
		//	array(
		//		'name'=>'User_Id', 'cols'=>array('id')
		//	),
		//	array(
		//		array('type'=>'unique', 'cols'=>array('id', 'email')),
		//		array('type'=>'primary key', 'cols'=>array('id'))
		//	));
	}

	public function GetBasic($ids=array()){
		if(!empty($ids)){
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

			foreach ($ids as $i => $id) {
				if(!array_key_exists($id, $users)){
					$users[$id] = 'Null';
				}
			}
			
			return $users;
		}else{
			return array();
		}
	}

	public function GetByID($id){
		if(array_key_exists($id, self::$_members)){
			return self::$_members[$id];
		}else{
			$data = $this->find(array(
				'conditions' => 'id='.$id,
				'single' => true
			));
	
			if(empty($data)){
				return null;
			}else{
				$member = new Member($data);
				self::$_members[$member->ID()] = $member;
				return $member;
			}
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
			self::$_members[$member->ID()] = $member;
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
			self::$_members[$member->ID()] = $member;
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
			self::$_members[$member->ID()] = $member;
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
			'username'          	=> $user->Username(),
			'email'             	=> $user->Email(),
			'password'          	=> $user->Password(),
			'birtdate'          	=> $user->Password(),
			'country'           	=> $user->Country(),
			'confirmed'         	=> $user->Confirmed(),
			'confirmation_token'	=> $user->ConfirmationToken(),
			'connection_token'  	=> $user->ConnectionToken()
		);

		$this->save($user->ID(), $data);
	}

	public function AutoReconnect($user){
		$token = md5(uniqid($user->ID(), true));
		$user->connection_token = $token;

		setcookie('connection_token', $token, time() + 86400*30);

		$this->Update($user);
	}
}