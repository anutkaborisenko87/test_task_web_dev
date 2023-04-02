<?php

use TestWebDev\app\controllers\HomeController;
use TestWebDev\src\Router;

Router::get("/", [HomeController::class, 'index']);
Router::get("/get_users", [HomeController::class, 'jsonData']);