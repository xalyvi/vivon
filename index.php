<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

ob_start();
session_start();

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Autoload.php');
header('Content-Type: text/html; charset=utf-8');
$router = new Router();
$router->run();
