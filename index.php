<?php
define('WEBROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('DB_NAME', 'gamma');
define('DEFAULT_CONTROLLER', 'home');
define('DEFAULT_ACTION', 'index');


require ROOT.'core/model.php';
require ROOT.'core/controller.php';

try{
	$Database = new PDO('mysql:host=localhost;dbname=gamma', DB_NAME, '');
	$Database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	$Database->exec("set names utf8");
}
catch(PDOException $e){
	echo "La base de donnée n'est pas disponible.";
}

$params = explode("/", $_GET['p']);
$controller = $params[0];
$action = isset($params[1]) ? $params[1] : null ;

Controller::load($controller, $action, $params);

?>
