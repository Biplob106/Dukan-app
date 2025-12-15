<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Get order ID from query string or route parameter
$orderId = $_GET['id'] ?? null; // adjust depending on your routing

if (!$orderId) {
    abort(404, "Order ID is required");
}

// Fetch the order
$order = $db->query("SELECT * FROM orders WHERE id = :id", ['id' => $orderId])->find();

if (!$order) {
    abort(404, "Order not found");
}

// Fetch all customers for dropdown
$customers = $db->query("SELECT * FROM customers ORDER BY name ASC")->fetchAll();

$products = $db->query("SELECT id , name FROM products ORDER BY name ASC ")->fetchAll();

$orderDetail = $db->query(
    "SELECT product_id FROM order_details WHERE order_id = :order_id LIMIT 1",
    ['order_id' => $orderId]
)->find();

$selectedProduct = $orderDetail['product_id'] ?? null;

// Pass to view
view('order/edit.view.php', [
    'heading'   => 'Edit Order',
    'order'     => $order,
    'customers' => $customers,
    'products' => $products,
    //'orderDetails' => $orderDetails,
    'selectedProduct' => $selectedProduct,
    'old'       => [] // for repopulating form after validation errors
]);
