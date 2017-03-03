<?php
session_start();
/**
* 	Set the time zone and get the autoloader working
*/
date_default_timezone_set('Europe/London');

//-- Set up dispaly errors for testing, comment out when live
ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

// load composer autoload
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

$dotenv = new Dotenv\Dotenv(__DIR__ . '/..//');
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USERNAME', 'DB_PASSWORD']);

$site_root = $_SERVER['DOCUMENT_ROOT'];
