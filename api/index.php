<?php

//----------------------------------------------------------------------------//
// BOOTSTRAP -----------------------------------------------------------------//
//----------------------------------------------------------------------------//
define('ROOT', dirname(dirname(__FILE__)));
require_once (ROOT . '/config/config.php');

//----------------------------------------------------------------------------//
// AUTOLOADER ----------------------------------------------------------------//
//----------------------------------------------------------------------------//
function presence_api_autoloader($class_name) {

    if (file_exists(ROOT . '/api/json/' . $class_name . '.php')) {
        require_once(ROOT . '/api/json/' . $class_name . '.php');
    }else if (file_exists(ROOT . '/lib/' . $class_name . '.php')) {
        require_once(ROOT . '/lib/' . $class_name . '.php');
    }else if (file_exists(ROOT . '/api/json/' . lcfirst($class_name) . '.class.php')) {
        require_once(ROOT . '/api/json/' . lcfirst($class_name) . '.class.php');
    }
}

spl_autoload_register('presence_api_autoloader');

//----------------------------------------------------------------------------//
// MANAGE DEPENDENCIES -------------------------------------------------------//
//----------------------------------------------------------------------------//
$dependencies = new DependencyContainer($CONFIG);

//----------------------------------------------------------------------------//
// API FRONT CONTROLLER ----------------------------------------------------------//
//----------------------------------------------------------------------------//

//TODO: filter requests - ALLOW only LAN!!!
//ROUTER ENABLE MAC FILTERING? - extra security

$method = $_SERVER['REQUEST_METHOD'];
$url = isset($_GET['url']) ? $_GET['url'] : null ; 

switch($method){
	case 'GET':
		$params = $_GET;
		break;
	case 'POST':
		$params = $_POST;
		break;
	default:
		API::errResponse('405', 'Method Not Allowed');
}

$url_fragments = explode ('/', $url);

if(count($url_fragments) > 2 || count($url_fragments) == 1){
	API::errResponse('400', 'Bad Request');
}else{
	$class = $url_fragments[0];
	$action = $url_fragments[1];
	
	new $class($dependencies, $action, $params);
}
