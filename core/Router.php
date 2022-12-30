<?php
namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    //route: tuyen duong
    protected array $routes = [];
    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    //C/n: khởi tạo ten và cảnh quan của tuyến đường dạng get
    public function get($path, $callback) {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback) {
        $this->routes['post'][$path] = $callback;
    }
    public function resolve()
    {
        //lay ten duong nguoi dung yeu cau
        $path = $this->request->getPath();
        $method = $this->request->method();
        //lay canh quan cua tuyen duong
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {//khong ton tai noi dung tuyen duong
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }
        if(is_string($callback)) {
            return $this->renderView($callback);
        };
        Application::$app->controller = $callback[0];
        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function layoutContent()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value ) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}