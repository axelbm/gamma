<?php
define('WEBROOT'           	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT'              	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('Site_Name'         	, 'Story Hub');
define('DB_NAME'           	, 'gamma');
define('DEFAULT_CONTROLLER'	, 'home');
define('DEFAULT_ACTION'    	, 'index');
define('DEFAULT_LAYOUT'    	, 'bootstrap');
define('PREVIOUS_PAGE'     	, (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : WEBROOT);

require ROOT.'core/util.php';
require ROOT.'core/model.php';
require ROOT.'core/controller.php';
require ROOT.'core/form.php';
require ROOT.'core/layout.php';

require ROOT.'core/member.php';
require ROOT.'core/form_view.php';

try{
	$Database = new PDO('mysql:host=localhost;dbname='.DB_NAME, DB_NAME, '');
	$Database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$Database->exec("set names utf8");
}
catch(PDOException $e){
	Controller::weberror('500', 'Base de donnée indisponible.');
}

session_start();

$params    	= explode("/", $_GET['p']);
$controller	= $params[0];
$action    	= isset($params[1]) ? $params[1] : null ;
unset($params[0]); unset($params[1]);

$data        	= array();
$data['post']	= $_POST;

$Controller = Controller::preload($controller, $action, $params, $data);


// if(isset($_SESSION['user_id']) & !empty($_SESSION['user_id'])){
//	$user_account = Member::GetByID($_SESSION['user_id']);
// }elseif(isset($_COOKIE['connection_key']) & !empty($_COOKIE['connection_key'])){

// }


$formid = isset($_POST['formid']) ? $_POST['formid'] : null ;
unset($_POST['formid']);


if(isset($formid)){
	$form = Form::load($formid, $_POST);

	if(!empty($form)){
		$Controller->form    	= $form;
		$Controller->formdata	= $form->GetData();
	}
}

$Controller->run();
?>
