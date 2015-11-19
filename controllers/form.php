<?php
class form extends Controller{

	function __construct($action=null, $params=null){
		$filename = ROOT.'controllers/forms/'.$action.'.php';

		if(file_exists($filename)){
			require($filename);
		}
		else{
			Controller::weberror('404', 'Le formulaire demandé n\'existe pas.');
		}
	}
}
?>