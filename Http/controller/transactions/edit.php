<?php 
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

//  Get transaction ID from query string
$transaction_id = $_GET['id'] ?? null;
if (!$transaction_id) {
    die('Transaction ID is required'); // or redirect to transaction list
}

//  Load the transaction from database
$transaction = $db->query(
    "SELECT * FROM transactions WHERE id = :id",
    ['id' => $transaction_id]
)->findOrFail();

// 3️Load customers and orders for select dropdowns
$customers = $db->query("SELECT id, name FROM customers ORDER BY name ASC")->fetchAll();
$orders = $db->query("SELECT id, invoice_number FROM orders ORDER BY id DESC")->fetchAll();

//  Determine the form data to pre-fill
// Use POST data if form is submitted (after validation fails), otherwise use transaction from DB
$old = !empty($_POST) ? $_POST : $transaction;

//  Pass all required data to the view
view('transaction/edit.view.php', [
    'customers' => $customers,
    'orders' => $orders,
    'old' => $old,
    'errors' => $errors
]);