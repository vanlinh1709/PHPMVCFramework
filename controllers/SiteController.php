<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;

class SiteController extends Controller
{
    public function contact()
    {
        $this->setLayout('auth');
        $params = Application::$app->request->getBody() ?? [];
        if (Application::$app->request->method() === 'post') {
            var_dump($params);
            die();
        }
        return $this->render('contact', $params);
    }
}