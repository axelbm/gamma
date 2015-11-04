<?php
define('WEBROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));

require ROOT.'core/model.php';
require ROOT.'core/controller.php';

mysql_connect("localhost", "gamma", "gammaweb")
    or die("Impossible de se connecter : " . mysql_error());
mysql_select_db('gamma')
	or die ('Impossible de sélectionner la base de données : ' . mysql_error());

		$data = array();
		$data['name'] = "Gamma";
		$data['text'] = "HelloWorld";

		$Model->save($data);

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
	echo 'error 404';
}
echo "end";
?>

