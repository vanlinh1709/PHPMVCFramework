<?php

namespace app\core;

use http\Env\Response;

class Router
{
    protected array $routes = [];
    public Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
         $path = $this->request->getPath();
         $method = $this->request->method();

         $callback = $this->routes[$method][$path] ?? false;
         if ($callback === false) {
             return $this->renderOnlyView('_404');
         }
         Application::$app->setController($callback[0]);
         return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params) {
        $viewContent = $this->renderOnlyView($view, $params);
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    public function renderOnlyView($view, $params = []) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

    public function layoutContent() {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }
}