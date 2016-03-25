<?php
namespace Apps;

class Controller extends \Gamma\Controller{
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
			$this->ToForm('user', $this->user);
		}
	}
}