<?php
namespace Apps\Controller;

class Page extends \Apps\Controller{

	function Init(){
	}

	function act_add($id=null){
		if($this->user){
			if(isset($id) & !empty($id)){
				$page   	= $this->Page->GetByID($id);
				$book   	= $this->Book->GetByID($page->Book());
				$answers	= $this->Answer->GetByPageID($id);
				$pages  	= $this->Page->GetByBookID($page->Book());

				if(empty($page)){
					Controller::weberror('404', 'La page est introuvable.');
				}

				
				$this->set('page',   	$page);
				$this->set('pages',  	$pages);
				$this->set('book',   	$book);
				$this->set('answers',	$answers);
				$this->render();
			}else{
				$this->noaction();
			}
		}else{
			Controller::weberror('500', 'Vous devez vous cconnecter pour acceder à cette page.');
		}
	}
}