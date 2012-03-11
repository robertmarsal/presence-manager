<?php

$CONFIG = new stdClass();

$CONFIG->wwwroot = 'http://localhost/presence-manager';

$CONFIG->debug= 1;
$CONFIG->verbose = 1;

$CONFIG->dbhost = 'localhost';
$CONFIG->dbname = 'presence';
$CONFIG->dbuser = 'root';
$CONFIG->dbpassword = '';

date_default_timezone_set('UTC');
