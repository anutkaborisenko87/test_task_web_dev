<?php

use TestWebDev\src\Application;
use TestWebDev\src\Request;

require_once 'vendor/autoload.php';
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
session_start();
$app = new Application(new Request());
$app->run();