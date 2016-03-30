<?php
define('WEBROOT'           	, preg_replace('(apps\/[^\/]*\.php)', '', $_SERVER['SCRIPT_NAME']));
define('ROOT'              	, preg_replace('([^\/]*\.php)', '', $_SERVER['SCRIPT_FILENAME']));
define('COREROOT'          	, preg_replace('(apps\/[^\/]*\.php)', 'core/', $_SERVER['SCRIPT_FILENAME']));
define('Site_Name'         	, 'Story Hub');
define('Language'          	, 'fr');
define('DB_NAME'           	, 'story_hub');
define('DB_PSW'            	, 'kiwi');
define('DEFAULT_CONTROLLER'	, 'home');
define('DEFAULT_ACTION'    	, 'index');
define('DEFAULT_LAYOUT'    	, 'bootstrap');
define('PREVIOUS_PAGE'     	, (isset($_SERVER["HTTP_REFERER"])) ? $_SERVER["HTTP_REFERER"] : WEBROOT);

require COREROOT.'database.php';
require COREROOT.'controller.php';
//require COREROOT.'form.php';
//require COREROOT.'form_view.php';
require COREROOT.'model.php';
require COREROOT.'util.php';

require COREROOT.'form/form.php';
require COREROOT.'form/view.php';
require COREROOT.'form/object.php';
require COREROOT.'form/message.php';

require ROOT.'controller.php';

session_start();

$params    	= explode("/", $_GET['params']);
$controller	= $params[0];
$action    	= isset($params[1]) ? $params[1] : null ;
$params = array_slice($params, 2);

$Controller = Gamma\Controller::load($controller, $action, $params);
?>
