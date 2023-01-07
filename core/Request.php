<?php

namespace app\core;

class Request
{
    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function isGet():bool
    {
        return $this->method() === 'get';
    }
    public function isPost():bool
    {
        return $this->method() === 'post';
    }
    //
    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function getBody(): array {
        if ($this->isGet()) return $_GET;
        return $_POST;
    }
}