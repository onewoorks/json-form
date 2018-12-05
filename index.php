<?php
session_start();
date_default_timezone_set("Asia/Kuala_Lumpur");
$params = explode('/', $_SERVER['REQUEST_URI']);

function ob_html_compress($buf){
    return preg_replace(array('/<!--(.*)-->/Uis',"/[[:blank:]]+/"),array('',' '),str_replace(array("\n","\r","\t"),'',$buf));
}

//ob_start("ob_html_compress");
define('APPS_NAME','jsonformnew');
define('SERVER_ROOT', __DIR__ .'/');
define('VIEW', 'application/views');
define('CONTROLLER', 'application/controllers');
define('MODEL', 'application/models');
define('INCLUDES', 'application/includes');
define('SITE', 'application/');
define('SCRIPTS', 'application/views/scripts/');
define('URL_ARRAY','2');

$_SESSION['project_path'] = $params[URL_ARRAY];
define('SITE_ROOT', 'http://localhost/'.APPS_NAME.'/'.$_SESSION['project_path']);
define('SITE_ASSET','http://localhost/'.APPS_NAME.'/');
define('PROJECT_PATH', $_SESSION['project_path']);
require_once(SERVER_ROOT . 'application/controllers/router.php');

// ob_end_flush();
