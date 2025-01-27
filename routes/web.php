<?php

use App\Http\Controllers\HomeController;
use Core\Router;

$router = Router::getInstance();

$router->addRoute('GET', '/', HomeController::class, 'index');
$router->addRoute('GET', '/get-todo', \App\Http\Controllers\ToDoController::class, 'getAll');
$router->addRoute('POST', '/store', \App\Http\Controllers\ToDoController::class, 'store');
$router->addRoute('POST', '/change-status', \App\Http\Controllers\ToDoController::class, 'changeStatus');
$router->addRoute('POST', '/remove', \App\Http\Controllers\ToDoController::class, 'remove');


$router->resolve();
