<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isGet()) {
            return $this->render("login");
        }
  }

    public function register(Request $request)
    {
        if ($request->isPost()) {
            return "Handle submitted data";
        }    
        return $this->render("register");
    }
}