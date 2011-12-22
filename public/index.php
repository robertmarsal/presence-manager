<?php 
//set the ROOT path
define('ROOT', dirname(dirname(__FILE__)));
require_once (ROOT.'/config/config.php');

session_start();
   
//----------------------------------------------------------------------------//
// AUTOLOADER ----------------------------------------------------------------//
//----------------------------------------------------------------------------//

function presence_autoloader($class_name){
    if (file_exists(ROOT.'/app/'.$class_name.'.class.php')) {
        require_once(ROOT.'/app/'.$class_name.'.class.php');
    }else if (file_exists(ROOT.'/app/controllers/'.$class_name.'.php')) {
        require_once(ROOT.'/app/controllers/'.$class_name.'.php');
    }else if (file_exists(ROOT.'/app/library/'.$class_name.'.php')) {
        require_once(ROOT.'/app/library/'.$class_name.'.php');
    }else if (file_exists(ROOT.'/app/views/'.$class_name.'.php')) {
        require_once(ROOT.'/app/views/'.$class_name.'.php');
    }
}

spl_autoload_register('presence_autoloader'); 
//----------------------------------------------------------------------------//
// MANAGE DEPENDENCIES -------------------------------------------------------//
//----------------------------------------------------------------------------//
global $config;
$dependencies = new DependencyContainer($config);

//----------------------------------------------------------------------------//
// BOOTSTRAPER ---------------------------------------------------------------//
//----------------------------------------------------------------------------//
/*if(isset($_POST['email']) && isset($_POST['password'])){
    $params->email = $_POST['email'];
    $params->password = $_POST['password'];
    new AuthController($dependencies, 'login', $params);
}
*/
    
$url = $_GET['url'];

if($url == null && $_SESSION['role'] == null){
    $controller = "LoginController";
    $action ="ask_login";
    $url_params = array();
}else if($url == null && isset($_SESSION['role'])){
    $controller = ucfirst($_SESSION['role']).'Controller';
    $action = 'index';
    $url_params = array();
}else{

    $url_params = explode('/',$url);
    $controller = ucfirst(array_shift($url_params)); //get the controller
    $controller .= 'Controller';    

    $action = $url_params[0] == null ? 'index' : array_shift($url_params);
}

$extra_params = $_POST;
new $controller($dependencies, $action, array_merge($url_params, $extra_params));
/*
if(isset($_SESSION['role'])){
          
    switch($_SESSION['role']){
        case 'user': 
            new UserController($dependencies, $action, $url_params);
            break;
        case 'admin':
            new AdminController($dependencies, $action, $url_params);
            break;
    }
}else{
    if($url == null){
        new LoginController($dependencies, 'ask_login', null);
    }else{
        new $controller.Controller($dependencies, $action, $url_params);
    }
}
*/