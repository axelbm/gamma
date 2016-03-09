<?php
define('WEBROOT'           	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT'              	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('Site_Name'         	, 'Story Hub');
define('DB_NAME'           	, 'story_hub');
define('DB_PSW'            	, 'kiwi');
define('DEFAULT_CONTROLLER'	, 'home');
define('DEFAULT_ACTION'    	, 'index');
define('DEFAULT_LAYOUT'    	, 'bootstrap');
define('PREVIOUS_PAGE'     	, (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : WEBROOT);

require ROOT.'core/database.php';
require ROOT.'core/controller.php';
require ROOT.'core/form.php';
require ROOT.'core/form_view.php';
require ROOT.'core/layout.php';
require ROOT.'core/model.php';
require ROOT.'core/util.php';
require ROOT.'core/form_view_new.php';

session_start();

$params    	= explode("/", $_GET['params']);
$controller	= $params[0];
$action    	= isset($params[1]) ? $params[1] : null ;
$params = array_slice($params, 2);

$Controller = Controller::load($controller, $action, $params);
?>
