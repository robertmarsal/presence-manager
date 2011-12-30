<?php 

//----------------------------------------------------------------------------//
// BOOTSTRAP -----------------------------------------------------------------//
//----------------------------------------------------------------------------//
//set the ROOT path
define('ROOT', dirname(dirname(__FILE__)));
require_once (ROOT.'/config/config.php');
global $config;

error_reporting(E_ALL);
$config['debug'] && ini_set('display_errors', '1');

//----------------------------------------------------------------------------//
// AUTOLOADER ----------------------------------------------------------------//
//----------------------------------------------------------------------------//

function presence_autoloader($class_name){
    
    global $config;
    
    if (file_exists(ROOT.'/app/'.lcfirst($class_name).'.class.php')) {
        require_once(ROOT.'/app/'.lcfirst($class_name).'.class.php');
    }else if (file_exists(ROOT.'/app/controllers/'.$class_name.'.php')) {
        require_once(ROOT.'/app/controllers/'.$class_name.'.php');
    }else if (file_exists(ROOT.'/app/library/'.$class_name.'.php')) {
        require_once(ROOT.'/app/library/'.$class_name.'.php');
    }else if (file_exists(ROOT.'/app/views/'.$class_name.'.php')) {
        require_once(ROOT.'/app/views/'.$class_name.'.php');
    }else{ //redirect to 404 page
        header('Location: '.$config['wwwroot'].'/error/notfound');
    }
}

spl_autoload_register('presence_autoloader'); 
//----------------------------------------------------------------------------//
// MANAGE DEPENDENCIES -------------------------------------------------------//
//----------------------------------------------------------------------------//
$dependencies = new DependencyContainer($config);

//----------------------------------------------------------------------------//
// FRONT CONTROLLER ----------------------------------------------------------//
//----------------------------------------------------------------------------//
session_start();

$url = isset($_GET['url']) ? $_GET['url'] : null;
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

if($url == null && $role == null){
    $controller = "AuthController";
    $action ="asklogin";
    $url_params = array();
}else if($url == null && isset($role)){
    $controller = ucfirst($role).'Controller';
    $action = 'activity';
    $url_params = array();
}else{
    $url_params = explode('/',$url);
    $controller = ucfirst(array_shift($url_params)); //get the controller
    $controller .= 'Controller';    
    $action = $url_params[0] == null ? 'activity' : array_shift($url_params);
}

$extra_params = $_POST;
new $controller($dependencies, $action, array_merge($url_params, $extra_params));
