<?php
define('WEBROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('Site_Name', 'Story Hub');
define('DB_NAME', 'gamma');
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'index');
define('PREVIOUS_PAGE', (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : WEBROOT);

require ROOT.'core/model.php';
require ROOT.'core/controller.php';
require ROOT.'core/form.php';
require ROOT.'core/util.php';

require ROOT.'core/member_account.php';
require ROOT.'core/member_profil.php';
require ROOT.'core/form_view.php';

try{
	$Database = new PDO('mysql:host=localhost;dbname='.DB_NAME, DB_NAME, '');
	$Database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$Database->exec("set names utf8");
}
catch(PDOException $e){
	Controller::weberror('500', 'Base de donnée indisponible.');
}

$params = explode("/", $_GET['p']);

$controller = $params[0];
$action = isset($params[1]) ? $params[1] : null ;
unset($params[0]); unset($params[1]);

$formid = isset($_POST['formid']) ? $_POST['formid'] : null ;
unset($_POST['formid']);
$formdata = array();

if(isset($formid)){
	$form = Form::load($formid, $_POST);
	$formdata = $form->GetData();
}


$data = array('post' => $_POST, 'formdata' => $formdata);
Controller::load($controller, $action, $params, $data);

?>
