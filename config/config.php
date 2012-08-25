<?php

$CONFIG = new stdClass();

$CONFIG->wwwroot = 'https://localhost/presence-manager';
$CONFIG->apiroot = $CONFIG->wwwroot.'/api/json';

$CONFIG->debug= 1;
$CONFIG->verbose = 1;
$CONFIG->lang = 'ca';

$CONFIG->dbhost = 'localhost';
$CONFIG->dbname = 'presence';
$CONFIG->dbuser = 'root';
$CONFIG->dbpassword = 'doremi';

date_default_timezone_set('UTC');
