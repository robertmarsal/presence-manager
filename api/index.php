<?php
define('ROOT', dirname(dirname(__FILE__)));
require_once (ROOT . '/config/config.php');
global $CONFIG;

// autoloader
spl_autoload_register(function ($class) {
    if (file_exists(ROOT . '/api/json/' . $class . '.php')) {
        require_once(ROOT . '/api/json/' . $class . '.php');
    }else if (file_exists(ROOT . '/lib/' . $class . '.php')) {
        require_once(ROOT . '/lib/' . $class . '.php');
    }
});

// create the DB connection
DB::setUp($CONFIG);

// validate and respond to the request
$method = $_SERVER['REQUEST_METHOD'];
$url = isset($_GET['url']) ? $_GET['url'] : null ;

switch($method){
	case 'GET':
		$params = (object) $_GET;
		break;
	case 'POST':
		$params = (object) $_POST;
		break;
	default:
        HTTP::response('405'); //Method Not Allowed
}

$url_fragments = explode ('/', trim($url, '/'));
if(count($url_fragments) != 3){
    HTTP::response('400'); //Bad Request
}

//format of the response
$format = $url_fragments[0];
//resource
$resource = $url_fragments[1];
//action to be made on the resource
$action = $url_fragments[2];
//check if the required format is implemented and if the resource exists
is_dir(ROOT.'/api/'.$format) && class_exists(ucfirst($resource))
        ? new $resource($action, $params)
        : HTTP::response('400'); //Bad Request