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
require ROOT.'core/member.php';

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
Controller::load($controller, $action, $params);

?>
