<?php
namespace Apps;

class Controller extends \Gamma\Controller{
	public $user;

	function MainInit(){
		if(isset($_SESSION['user_id']) & !empty($_SESSION['user_id'])){
			$this->user = $this->Member->GetByID($_SESSION['user_id']);
		}else{
			if(isset($_COOKIE['connection_token']) & !empty($_COOKIE['connection_token'])){
				$this->user = $this->Member->GetByConnectionToken($_COOKIE['connection_token']);
			}
		}

		if($this->user){
			$this->set('user', $this->user);
		}
		
		$this->set('m', $this->Resource->Menu());
		$this->set('lf', $this->Resource->Login_Form());

		$this->addjs('views/pages/'.$this->controller.'/js/javascript.js');
		$this->addjs('views/pages/'.$this->controller.'/js/'.$this->action.'.js');
		$this->addjs('views/layout/'.$this->layout.'/js/javascript.js');
		$this->addjs('views/pages/'.$this->controller.'/js/'.$this->controller.'.js');
	}

	function UserLogin($user){
		$this->user = $user;
		$_SESSION['user_id'] = $user->ID();
	}

	public function User(){
		return $this->user;
	}
}