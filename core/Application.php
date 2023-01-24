<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Database $db;
    public static Application $app;
    public Controller $controller;
    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
    public function __construct($rootDir, array $config)
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        $this->db = new Database($config['db']);
        self::$ROOT_DIR = $rootDir;
        self::$app = $this;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}