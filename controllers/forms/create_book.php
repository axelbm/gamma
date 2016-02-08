<?php
class form_create_book extends Form{
	protected $formfields = array('title', 'description', 'language', 'category', 'adult', 'perm_all', 'perm_members',
	 'group', 'perm_group', 'page_title', 'page_content');
	private $user;
	private $Book;
	private $Page;
	private $Answer;

	function init(){
		$this->Book  	= $this->Controller->loadModel('book');
		$this->Page  	= $this->Controller->loadModel('page');
		$this->Answer	= $this->Controller->loadModel('answer');
		$user        	= $this->Controller->user;

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
			$this->error('nope');
			return false;
		}
	}

	function check_description($des){
		if(isset($des) & !empty($des)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}

	function check_language($lang){
		if(isset($lang) & !empty($lang)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}

	function check_category($cat){
		if(isset($cat) & !empty($cat)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}

	function check_perm($perm, $targ){
		if(isset($perm) & !empty($perm)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}

	function check_group_id($id){
		if(isset($id) & !empty($id)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}

	function check_page_title($title){
		if(isset($title) & !empty($title)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}

	function check_page_content($cont){
		if(isset($cont) & !empty($cont)){
			return true;
		}else{
			$this->error('nope');
			return false;
		}
	}
}