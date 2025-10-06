<?php

$router->get('/', 'index.php')->only('auth');
$router->get('/product', 'products/product.php')->only('auth');
$router->get('/register','registration/create.php');
$router->post('/register','registration/store.php');
$router->get('/login','sessions/create.php');
$router->post('/sessions','sessions/store.php');
$router->delete('/sessions','sessions/destroy.php')->only('auth');
$router->get('/product/create','products/create.php')->only('auth');
$router->post('/product','products/store.php')->only('auth');
$router->delete('/product','products/destroy.php')->only('auth');