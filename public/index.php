<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

require_once dirname(__DIR__).'/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
//
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
//
$app = new Application(dirname(__DIR__), $config);

//Khởi tạo ra các routes theo ý đồ của ta.
$app->router->get('/', [new SiteController(), 'home']);
$app->router->get('/contact', [new SiteController(), 'contact']);
$app->router->post('/contact',[new SiteController(), 'contact']);
//
$app->router->get('/register', [new AuthController(), 'register']);
$app->router->post('/register', [new AuthController(), 'register']);
//
$app->router->get('/login', [new AuthController(), 'login']);
$app->router->post('/login', [new AuthController(), 'login']);
//
$app->run();



