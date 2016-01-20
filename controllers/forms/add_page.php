<?php
class form_add_page extends Form{
	var $formfields = array('answer', 'title', 'content', 'page', 'action');
	
	function fail(){
		$Controller = Controller::$self;
		$Controller->setjs('hash', 'add_page');
		$Controller->setjs('page_add_tab', $this->value('action'));
		$Controller->setjs('page_select', $this->value('page'));
	}

	function success(){
		$this->fail();
	}
}