<?php
define('ROOT'              	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('WEBROOT'           	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('APPROOT'           	, ROOT.'app/');
define('COREROOT'          	, ROOT.'core/');
define('Site_Name'         	, 'StoryHub');
define('Language'          	, 'fr');
define('DB_NAME'           	, 'story_hub');
define('DB_PSW'            	, 'kiwi');
define('DEFAULT_CONTROLLER'	, 'home');
define('DEFAULT_ACTION'    	, 'index');
define('DEFAULT_LAYOUT'    	, 'bootstrap');
define('PREVIOUS_PAGE'     	, (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : WEBROOT);

require COREROOT.'database.php';
require COREROOT.'controller.php';
require COREROOT.'model.php';
require COREROOT.'util.php';
require COREROOT.'form/form.php';
require COREROOT.'form/view.php';
require COREROOT.'form/object.php';
require COREROOT.'form/message.php';

require APPROOT.'controller.php';

session_start();

$params    	= explode("/", $_GET['params']);
$controller	= $params[0];
$action    	= isset($params[1]) ? $params[1] : null ;
$params = array_slice($params, 2);

$Controller = Gamma\Controller::load($controller, $action, $params);
