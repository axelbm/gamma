<?php
class form extends Controller{
	function login(){
		header("location:".WEBROOT);
	}

	function signup(){
		header("location:".WEBROOT);
	}

	function noaction($action, $params){
		Controller::load('error', '404', array('Le formulaire demandé n\'existe pas.'));
	}
}
?>