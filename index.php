<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

ob_start();
session_start();

$blob;
define('ROOT', dirname(__FILE__));
header('Content-Type: text/html; charset=utf-8');
require_once(ROOT.'/components/Autoload.php');
$router = new Router();
$router->run();
