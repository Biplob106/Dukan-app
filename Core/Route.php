<?php

namespace Core;
use Core\Middleware\Middleware;

require __DIR__ . '/Middleware/Middleware.php';
require __DIR__ . '/Middleware/Auth.php';
require __DIR__ . '/Middleware/Guest.php';
class Route
{
    public $routes = [];


    public function add($method,$uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];

    return $this;
        
    }

    public function get($uri, $controller)
    {
       return $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
      return   $this->add('POST', $uri, $controller);
    }

    public function patch($uri, $controller)
    {
       return $this->add('PATCH', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
      return  $this->add('DELETE', $uri, $controller);
    }

    public function put($uri, $controller)
    {
       return $this->add('PUT', $uri, $controller);
    }

    public function only($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }
     public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {

                //apply the middleware
              
            Middleware::resolve($route['middleware']);

               // if($route['middleware']==='guest')
               // {
                //  (new Guest)->handle();
                //}
               //  if($route['middleware']==='auth')
              //  {
               //     (new Auth)->handle();
              //  }
                return require base_path('Http/controller/'.$route['controller']);
            }
        }

        $this->abort();
    }

    protected function abort($code = 404)
    {
        http_response_code($code);
        require base_path("views/{$code}.php");
        die();
    }
   
}