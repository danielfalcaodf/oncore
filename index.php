<?php
ob_start();
session_start();

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());
$router->namespace("Source\Controllers");
//  web 
$router->group(null);
$router->get("/", "App:home", "app.home");
$router->get("/filesystems", "App:filesystems", "app.filesystems");
$router->get("/login", "App:login", "app.login");
// $router->get("/cadastrar", "Web:register", "web.register");
// $router->get("/recuperar", "Web:forget", "web.forget");
// $router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");

// AUTH
$router->group(null);
$router->post("/singin", "Auth:login", "auth.login");
// $router->post("/register", "Auth:register", "auth.register");
// $router->post("/forget", "Auth:forget", "auth.forget");
// $router->post("/reset", "Auth:reset", "auth.reset");
// FileSystems
$router->group("/fylesystem");
$router->get('/openfile/{path}/{file}', 'Fylesystem:openFile', 'fylesystem.openFile');
$router->get('/openfolder/{folder}', 'Fylesystem:pathTo', 'fylesystem.pathTo');
$router->get('/pathBack', 'Fylesystem:pathBack', 'fylesystem.pathBack');



// profile
// $router->group("/me");
// $router->get('/', 'App:home', 'app.home');
// $router->get('/sair', 'App:logoff', 'app.logoff');
// errors 
// $router->group('ops');
// $router->get('/{errcode}', 'Web:error',  "web.error");
// router process
$router->dispatch();

// error process

// if ($router->error()) {
//     $router->redirect("web.error", ["errcode" => $router->error()]);
// }

ob_end_flush();