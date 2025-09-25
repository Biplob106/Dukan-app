<?php 


use Core\Route;
use Core\App;
use Core\Session;

session_start();
require('../Core/function.php');

spl_autoload_register(function($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("{$class}.php");
});  

$router = new Core\Route();

// load routes
require base_path('routes.php');

require base_path('bootstrap.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path']; 
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

//dd($method);

$router->route($uri, $method);

Session::unflash();