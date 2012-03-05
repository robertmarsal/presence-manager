<?php

$CONFIG = new stdClass();

$CONFIG->wwwroot = 'http://127.0.0.1:8888/presence-manager';

$CONFIG->debug= 1;
$CONFIG->verbose = 1;

$CONFIG->dbhost = 'localhost';
$CONFIG->dbname = 'presence';
$CONFIG->dbuser = 'root';
$CONFIG->dbpassword = '';

date_default_timezone_set('UTC');
