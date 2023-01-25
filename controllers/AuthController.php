<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\Login;
use app\models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->setLayout('auth');
        $registerModel = new User();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate()) {
                return 'Success';
            }
            $errors = $registerModel->errors;
            return $this->render('register',
                [
                    'registerModel' => $registerModel
                ]);
        }
        return $this->render('register', [
            'registerModel' => $registerModel
        ]);
    }
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $loginModel = new Login();
            $loginModel->loadData($request->getBody());
            if ($loginModel->validate()) {
                return 'Success';
            }
            $errors = $loginModel->errors;
            return $this->render('login', [
                'errors' => $errors
            ]);
        }
        $this->setLayout('auth');
        return $this->render('login');
    }
}