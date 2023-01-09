<?php

namespace app\controllers;

use app\core\Controller;

class AuthController extends Controller
{

    public function register()
    {
        $this->setLayout('auth');
        return $this->render('register');
    }
}