<?php

use Core\Database;
use Core\App;

 $db = App::resolve(Database::class);

// // Fetch all products

// $products = $db->query("SELECT * FROM products LEFT JOIN images ON products.id = images.product_id ;")->fetchAll();

$products = $db->query("SELECT * FROM products")->fetchAll();

// Attach images to each product
foreach ($products as &$product) {
    $product['images'] = $db->query(
        "SELECT * FROM images WHERE product_id = :id",
        ['id' => $product['id']]
    )->fetchAll();
}
unset($product); // break reference

// Pass to view
view('product/product.view.php', [
    'heading' => 'All Products',
    'products' => $products
]);