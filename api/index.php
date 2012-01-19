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

    global $CONFIG;

    if (file_exists(ROOT . '/api/' . $class_name . '.php')) {
        require_once(ROOT . '/api/' . $class_name . '.php');
    }else if (file_exists(ROOT . '/lib/' . $class_name . '.php')) {
        require_once(ROOT . '/lib/' . $class_name . '.php');
    }else if (file_exists(ROOT . '/api/' . lcfirst($class_name) . '.class.php')) {
        require_once(ROOT . '/api/' . lcfirst($class_name) . '.class.php');
    }
}

spl_autoload_register('presence_api_autoloader');

//----------------------------------------------------------------------------//
// MANAGE DEPENDENCIES -------------------------------------------------------//
//----------------------------------------------------------------------------//
$dependencies = new DependencyContainer($CONFIG);

//----------------------------------------------------------------------------//
// FRONT CONTROLLER ----------------------------------------------------------//
//----------------------------------------------------------------------------//

$method = isset($_POST['method']) ? $_POST['method'] : null;
$action = isset($_POST['action']) ? $_POST['action'] : null;
$params = array_merge($_GET, $_POST);

if($method && $action){
	new $method($dependencies, $action, $params);
}else{
	print json_encode(array( 'error' => '1',
							 'message' => 'Bad API call'));
}
