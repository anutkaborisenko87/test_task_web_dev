<?php

use TestWebDev\app\controllers\HomeController;
use TestWebDev\app\controllers\UsersController;
use TestWebDev\src\Router;

Router::get("/", [HomeController::class, 'index']);
Router::get("/get_users", [UsersController::class, 'index']);
Router::post("/new_user", [UsersController::class, 'create']);
Router::put("/edit_user", [UsersController::class, 'update']);
Router::delete("/delete_user", [UsersController::class, 'delete']);