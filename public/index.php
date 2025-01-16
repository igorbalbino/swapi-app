<?php

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Logger.php';
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../controllers/FilmController.php';
require_once __DIR__ . '/../controllers/PeopleController.php';
require_once __DIR__ . '/../controllers/LogController.php';

// Conexão com o banco de dados e Logger
$db = new Database();
$logger = new Logger($db);

// Instancia o Router
$router = new Router();

// Configuração das rotas
$router->addRoute('/', [FilmController::class, 'index']);
$router->addRoute('/films/details', function() {
    $filmController = new FilmController();
    $filmController->details($_GET['search']);
});

$router->addRoute('/people', [PeopleController::class, 'index']);
$router->addRoute('/people/details', function() {
    $peopleController = new PeopleController();
    $peopleController->details($_GET['search']);
});

$router->addRoute('/logs', [LogController::class, 'index']);

// Dispara o roteamento
$router->dispatch();