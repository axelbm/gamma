<?php
namespace Apps\Form\Book;

class Create extends \Gamma\Form{
	private $user;

	protected function Init(){
		$this->DefaultObject(['action']);

		$user = $this->controller->User();

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->Fail();
		}
	}


} 