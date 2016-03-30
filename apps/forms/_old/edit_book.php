<?php
namespace Apps\Form\_Old;

class form_edit_book extends \Gamma\Old\Form{
	protected $formfields = array('title', 'description', 'language', 'category', 'starting_page', 'adult');

	function init(){
		$this->book	= $this->Controller->book;
		$user      	= $this->Controller->user;

		if(!empty($user)){
			$this->user = $user;
		}else{
			$this->formerror('L\'utilisateur est introuvable.');
			$this->fail();
		}
	}

	function check_title($title){
		if(isset($title) & !empty($title)){
			return true;
		}else{
			$this->error('Vous devez enter un titre.');
			return false;
		}
	}

	function check_description($desc){
		if(isset($desc) & !empty($desc)){
			return true;
		}else{
			$this->error('Vous devez enter un titre.');
			return false;
		}
	}

	function check_language($lang){
		if(isset($lang) & !empty($lang)){
			return true;
		}else{
			$this->error('Vous devez enter un titre.');
			return false;
		}
	}

	function check_category($category){
		if(isset($category) & !empty($category)){
			return true;
		}else{
			$this->error('Vous devez enter un titre.');
			return false;
		}
	}


	function success(){
		
	}
}