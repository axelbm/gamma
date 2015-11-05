<?php
define('WEBROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('DB_NAME', 'gamma');

require ROOT.'core/model.php';
require ROOT.'core/controller.php';

try{
	$Database = new PDO('mysql:host=localhost;dbname=gamma', DB_NAME, 'gammaweb');
	$Database->setAttribute(PDO::ATTR_ERRMODE, PPO::ERRMODE_WARNING);
}
catch(PDOException $e){
	echo "La base de donnée n'est pas disponible.";
}

$params = explode("/", $_GET['p']);

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
	unset($params[0]); unset($params[1]);
	call_user_func_array(array($controller, $action), $params);
	// $controller->$action();
}
else{
	echo 'error 404';
}
echo "end";
?>
