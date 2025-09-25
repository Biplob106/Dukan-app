<?php 


use Core\Route;
use Core\App;
use Core\Session;

require __DIR__ . '/../Core/Route.php';
require __DIR__ . '/../Core/function.php';

$router = new Route();

// load routes
require base_path('routes.php');

//require base_path('bootstrap.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path']; 
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

//dd($method);

$router->route($uri, $method);

?>