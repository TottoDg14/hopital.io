<?php

namespace Config;

class Router 
{
    private $basepath;
    public $routes;
    private $url;
    private $uri;

    public function get()
    {
        $this->url = $this->getURI();
        $this->routes = explode('/', $this->url);
    }

    private function getURI()
    {
        $this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));
        if (strstr($this->uri, '?')) $this->uri = substr($this->uri, 0, strpos($this->uri, '?'));
        $this->uri = '/' . trim($this->uri, '/');
        return $this->uri;
    }

    public function runAction($action) 
    {
        if($action instanceof \Closure)
        {
            $action();
        }  
        else 
        {
            $params = explode('@', $action);
            $params[0] = 'Api\\' . $params[0];
            $obj = new $params[0];
            $obj->{$params[1]}();
        }
    }

}
?>