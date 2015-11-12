<?php
class form extends Controller{
	function login(){
		header("location:".WEBROOT);
	}

	function signup(){
		header("location:".WEBROOT);
	}

	function noaction($action, $params){
		Controller::weberror('404', 'Le formulaire demandé n\'existe pas.');
	}
}
?>