<?php 

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

// Get order ID from query string or route parameter
$order_id = $_GET['id'] ?? null; // adjust depending on your routing

if (!$order_id) {
    abort(404, "Order ID is required");
}

// Fetch the order
$order = $db->query("SELECT * FROM orders WHERE id = :id", ['id' => $order_id])->find();

if (!$order) {
    abort(404, "Order not found");
}

// Fetch all customers for dropdown
$customers = $db->query("SELECT * FROM customers ORDER BY name ASC")->fetchAll();

// Pass to view
view('order/edit.view.php', [
    'heading'   => 'Edit Order',
    'order'     => $order,
    'customers' => $customers,
    'old'       => [] // for repopulating form after validation errors
]);
