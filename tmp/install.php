<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
    </head>
<body class="well">
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once '../config/config.php';
global $CONFIG;

//check if config data is set
if(!$CONFIG){
    echo '<div class="alert alert-error">
             Configuration file not found! Please create config/config.php file
          </div>';
    die();
}

// set up the database connection
require_once '../lib/DB.php';
DB::setUpNoDB($CONFIG);

//create the database
echo 'Creating the database <b>'.$CONFIG->dbname.'</b></br>';
$presence_db_sql = 'CREATE DATABASE '.$CONFIG->dbname.' ;';
DB::runSQL($presence_db_sql, array());

//create the tables
//presence_activity
$presence_activity_table_sql = '
    USE '.$CONFIG->dbname.';
    CREATE TABLE IF NOT EXISTS `presence_activity` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `userid` varchar(250) COLLATE utf8_bin NOT NULL,
    `action` varchar(50) COLLATE utf8_bin NOT NULL,
    `timestamp` int(15) NOT NULL,
    `computed` tinyint(1) NOT NULL DEFAULT \'0\',
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';
echo 'Creating the table <b>presence_activity</b></br>';
DB::runSQL($presence_activity_table_sql, array());


//presence_auth
$presence_auth_table_sql = '
    USE '.$CONFIG->dbname.';
    CREATE TABLE IF NOT EXISTS `presence_auth` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `userid` int(11) NOT NULL,
    `token` varchar(40) NOT NULL,
    `timeexpires` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';
echo 'Creating the table <b>presence_auth</b></br>';
DB::runSQL($presence_auth_table_sql, array());

//presence_intervals
$presence_intervals_table_sql = '
    USE '.$CONFIG->dbname.';
    CREATE TABLE IF NOT EXISTS `presence_intervals` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `userid` int(11) NOT NULL,
    `timestart` int(15) NOT NULL,
    `timestop` int(15) NOT NULL,
    `timediff` int(11) NOT NULL,
    `week` int(11) NOT NULL,
    `month` int(11) NOT NULL,
    `year` int(4) NOT NULL,
    `y` int(11) NOT NULL,
    `m` int(11) NOT NULL,
    `d` int(11) NOT NULL,
    `h` int(11) NOT NULL,
    `i` int(11) NOT NULL,
    `s` int(11) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';
echo 'Creating the table <b>presence_intervals</b></br>';
DB::runSQL($presence_intervals_table_sql, array());

//presence_users
$presence_users_table_sql = '
    USE '.$CONFIG->dbname.';
    CREATE TABLE IF NOT EXISTS `presence_users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `identifier` varchar(150) COLLATE utf8_bin NOT NULL,
    `password` char(40) COLLATE utf8_bin NOT NULL,
    `role` varchar(20) COLLATE utf8_bin NOT NULL,
    `firstname` varchar(200) COLLATE utf8_bin NOT NULL,
    `lastname` varchar(300) COLLATE utf8_bin NOT NULL,
    `position` varchar(200) COLLATE utf8_bin NOT NULL,
    `UUID` char(40) COLLATE utf8_bin NOT NULL,
    `mac` char(40) COLLATE utf8_bin NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;';
echo 'Creating the table <b>presence_users</b></br>';
DB::runSQL($presence_users_table_sql, array());

echo 'Done creating the database!</br>';
?>
</body>
</html>