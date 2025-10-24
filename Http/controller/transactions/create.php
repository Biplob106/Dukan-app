<?php 
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$old = $_POST ?? [];
$errors = [];


$customers = $db->query("SELECT id, name FROM customers")->fetchAll();
$orders = $db->query("SELECT * FROM orders")->fetchAll();

view('transaction/create.view.php', [
    'customers' => $customers,
    'orders' => $orders,
    'old' => $_POST ?? [],
    'errors' => $errors ?? []
]);
