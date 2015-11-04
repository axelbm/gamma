<?php
define('WEBROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));

require ROOT.'core/model.php';
require ROOT.'core/controller.php';

$params = explode('/', $_GET['p']);

if(!isset($params[0]) or $params[0] == '')
	$controller = 'home';
else
	$controller = $params[0];

if(!isset($params[1]) or $params[1] == '')
	$action = 'index';
else
	$action = $params[1];


require(ROOT.'controllers/'.$controller.'.php');
$controller = new $controller();

if(method_exists($controller, $action)){
	$controller->$action();
}
else{
	echo md5("test");
}

?>

