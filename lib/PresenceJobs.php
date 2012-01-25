<?php
// Include Class
error_reporting(E_ALL);
require_once "System/Daemon.php";
require_once (dirname(dirname(__FILE__)). '/config/config.php');
require_once "DependencyContainer.php";

// No PEAR, run standalone
System_Daemon::setOption("usePEAR", false);

// Bare minimum setup
System_Daemon::setOption("appName", "presence");
System_Daemon::setOption("appDir", dirname(__FILE__));

// Spawn Deamon!
System_Daemon::start();

// Jobs Go Here!
while(true){
    System_Daemon::log(System_Daemon::LOG_INFO, "Begin job");
    //create dependencies container
    $dependencies = new DependencyContainer($CONFIG);
    $_db = $dependencies->get_db();

    sleep(5);
}
