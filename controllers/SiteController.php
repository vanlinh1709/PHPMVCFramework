<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Router;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            "title" => "Home"
        ];
        return $this->render("home", $params);
    }
    public function contact()
    {
        return $this->render("contact");
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return "Handling submited data";
    }
}