<?php

$router->get('/', 'index.php');
$router->get('/product', 'products/product.php');
$router->get('/register','registration/create.php');
$router->post('/register','registration/store.php');