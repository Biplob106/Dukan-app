<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

// Fetch all products
$products = $db->query("SELECT * FROM products ORDER BY id ASC")->fetchAll();

// Pass to view
view('product/product.view.php', [
    'heading' => 'All Products',
    'products' => $products
]);