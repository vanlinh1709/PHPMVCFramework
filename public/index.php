<?php

use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;
require_once dirname(__DIR__).'/vendor/autoload.php';

$app = new Application(dirname(__DIR__));

//Khởi tạo ra các routes theo ý đồ của ta.
$app->router->get('/', [new SiteController(), 'home']);
$app->router->get('/contact', [new SiteController(), 'contact']);
$app->router->post('/contact',[new SiteController(), 'contact']);
//
$app->router->get('/register', [new AuthController(), 'register']);
$app->router->post('/register', [new AuthController(), 'register']);
$app->run();



