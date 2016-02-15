<?php
class form_create_book extends Form{
	protected $formfields = array('title', 'description', 'language', 'category', 'adult', 'perm_all', 'perm_members',
	 'group', 'perm_group'/*, 'page_title', 'page_content'*/);
	private $user;

	function init(){
		$user = $this->Controller->user;

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
			$this->error('Vous devez donner un titre a votre livre.');
			return false;
		}
	}

	function check_description($des){
		if(isset($des) & !empty($des)){
			return true;
		}else{
			$this->error('Vous devez écrire un description pour introduire votre livre.');
			return false;
		}
	}

	function check_language($lang){
		if(isset($lang) & !empty($lang)){
			$language = array('FR' => 'Français', 'EN' => 'Anglais', 'LT' => 'Latin');

			if(isset($language[$lang])){
				return true;
			}else{
				$this->error('Il y a une erreur dans la sélection.');
				return false;
			}
		}else{
			$this->error('Vous devez sélectionner une langue.');
			return false;
		}
	}

	function check_category($cat){
		if(isset($cat) & !empty($cat)){
			$data = $this->Categories->Check($cat);

			if($data){
				return true;
			}else{
				$this->error('Il y a une erreur dans la sélection.');
				return false;
			}
		}else{
			$this->error('Vous devez sélectionner une catégorie.');
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

	// function check_page_title($title){
	//	return true;
	// }

	// function check_page_content($cont){
	//	if(isset($cont) & !empty($cont)){
	//		return true;
	//	}else{
	//		$this->error('Vous devez écrire le contenue de votre première page!');
	//		return false;
	//	}
	// }

	function success(){
		$data = array(
			'title'      	=> $this->value('title'),
			'description'	=> $this->value('description'),
			'language'   	=> $this->value('language'),
			'category'   	=> $this->value('category'),
			'adult'      	=> $this->value('adult')?1:0,
			'creator'    	=> $this->user->GetID(),
			'permition'  	=> '777'
		);

		$id = $this->Book->Create($data);

		if($id){
			header("Location: ".WEBROOT.'book/view/'.$id);
		}else{
			$this->formerror('Erreur');
			$this->fail();
		}
	}
}