<?php

namespace app\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');//Tra ve vi tri cua dau ?
        if ($position === false) {//khong ton tai dau ?
            return $path;
        }
         return substr($path, 0, $position);//return ra path khong co dau ? tro di
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}