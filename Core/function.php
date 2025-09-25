<?php

function    isActive($path){
    
   $link = $_SERVER['REQUEST_URI'] === $path ? 'bg-red-900' : '';
   echo $link;
}
function dd($value)
{
echo "
<pre>";
    var_dump($value);
    echo "</pre>";

die();
}


define('BASE_PATH', __DIR__ . '/..'); // Root path of your project

function base_path($path)
{
    return BASE_PATH . '/' . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}


function abort($code = 404)
{
    http_response_code($code);

    // Check if the view exists
    $file = base_path("views/{$code}.php");
    if (file_exists($file)) {
        require $file;
    } else {
        // Fallback if the view is missing
        echo "<h1>{$code} - Something went wrong</h1>";
    }

    exit; // Stop further execution
}function authorize ($condition)
{
    if (!$condition) {
        abort(403);
    }
}
function redirect($path){

    header("location : {$path}");
    exit();
}