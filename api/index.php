<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Logger.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/FilmController.php';
require_once __DIR__ . '/../controllers/LogController.php';

// Conexão com o banco de dados e Logger
$db = new Database();
$logger = new Logger($db);

// Instancia o Router
$router = new Router();

// Configuração das rotas
$router->addRoute('/api/films', function(){
    $controller = new FilmController();
    $controller->list('films');
});
$router->addRoute('/api/films/details/{id}', function() {
    $filmController = new FilmController();
    $filmController->details($_GET['search']);
});
// $router->addRoute('/people', function() use (){
//     $controller = new FilmController();
//     $controller->list('people');
// });
// $router->addRoute('/people/details/{id}', function($id) use () {
//     $filmController = new FilmController();
//     $id = isset($id[0]) ? (int)$id[0] : 0;
//     $filmController->details('people', $id);
// });
// $router->addRoute('/starships', function() use (){
//     $controller = new FilmController();
//     $controller->list('starships');
// });
// $router->addRoute('/starships/details/{id}', function($id) use () {
//     $filmController = new FilmController();
//     $id = isset($id[0]) ? (int)$id[0] : 0;
//     $filmController->details('starships', $id);
// });
// $router->addRoute('/planets', function() use (){
//     $controller = new FilmController();
//     $controller->list('planets');
// });
// $router->addRoute('/planets/details/{id}', function($id) use () {
//     $filmController = new FilmController();
//     $id = isset($id[0]) ? (int)$id[0] : 0;
//     $filmController->details('planets', $id);
// });

// Dispara o roteamento
$router->dispatch();