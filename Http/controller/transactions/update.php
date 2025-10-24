<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

// Get transaction ID
$id = $_POST['id'] ?? null;
if (!$id) {
    die('Transaction ID is required');
}

// Validate input
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PATCH'){
$customer_id = $_POST['customer_id'] ?? '';
$order_id = $_POST['order_id'] ?? '';
$amount = $_POST['amount'] ?? '';
$method = $_POST['method'] ?? '';
$created_at = $_POST['created_at'] ?? '';

if (!$customer_id) {
    $errors['customer_id'] = 'Customer is required.';
}
if (!$order_id) {
    $errors['order_id'] = 'Order is required.';
}
if (!$amount) {
    $errors['amount'] = 'Amount is required.';
}
if (!$method) {
    $errors['method'] = 'Payment method is required.';
}

if (!empty($errors)) {
    // Re-load supporting data and show form again
    $customers = $db->query("SELECT id, name FROM customers")->fetchAll();
    $orders = $db->query("SELECT id, invoice_number FROM orders")->fetchAll();

    view('transaction/edit.view.php', [
        'customers' => $customers,
        'orders' => $orders,
        'old' => $_POST,
        'errors' => $errors
    ]);
    exit;
}

// Update the transaction
$db->query("
    UPDATE transactions 
    SET 
        customer_id = :customer_id,
        order_id = :order_id,
        amount = :amount,
        method = :method,
        created_at = :created_at
    WHERE id = :id
", [
    'customer_id' => $customer_id,
    'order_id' => $order_id,
    'amount' => $amount,
    'method' => $method,
    'created_at' => $created_at,
    'id' => $id
]);

// Redirect after update
header("Location: /transaction");
exit;
}