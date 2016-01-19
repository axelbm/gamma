<?php
class form_user_setting extends Form{
	
	
	function fail(){
		$Controller = Controller::$self;
		$Controller->setjs('user_edit_tab', 'setting');
		$Controller->setjs('hash', 'user_setting');
	}

	function success(){
		$this->fail();
	}
}