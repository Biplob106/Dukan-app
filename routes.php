<?php

$router->get('/', 'index.php')->only('auth');
$router->get('/product', 'products/product.php');
$router->get('/register','registration/create.php');
$router->post('/register','registration/store.php');
$router->get('/login','sessions/create.php');
$router->post('/sessions','sessions/store.php');
$router->delete('/sessions','sessions/destroy.php')->only('auth');
$router->get('/product/create','products/create.php');
$router->post('/product','products/store.php');
$router->delete('/product','products/destroy.php');
$router->get('/product/edit','products/edit.php');
$router->patch('/product', 'products/update.php');
$router->get('/customer', 'customers/index.php');
$router->get('/customer/create','customers/create.php');
$router->post('/customer','customers/store.php');
$router->get('/customer/edit','customers/edit.php');
$router->patch('/customer','customers/update.php');
$router->delete('/customer','customers/destroy.php');
$router->get('/image', 'images/index.php');