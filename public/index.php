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
if(isset($_POST['email']) && isset($_POST['password'])){
    $params->email = $_POST['email'];
    $params->password = $_POST['password'];
    new AuthController($dependencies, 'login', $params);
}

if(isset($_SESSION['role'])){
    
    $url = $_GET['url'];
    
    $url_fragments = empty($url) ? null : explode('/',$url);
    $url_fragments && array_shift($url_fragments); //remove the controller
    
    $action = $url_fragments[0] == null ? 'index' : array_shift($url_fragments);
                
    switch($_SESSION['role']){
        case 'user': 
            new UserController($dependencies, $action, $url_fragments);
            break;
        case 'admin':
            new AdminController($dependencies, $action, $url_fragments);
            break;
    }
}else{
    new LoginController($dependencies, 'ask_login', null);
}
