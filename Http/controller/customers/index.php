<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

// Fetch all products
$customers = $db->query("SELECT * FROM customers ORDER BY id ASC")->fetchAll();

// Pass to view
view('customer/index.view.php', [
    'heading' => 'All Customer',
    'customers' => $customers
]);