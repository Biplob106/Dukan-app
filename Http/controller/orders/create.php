
<?php 
use Core\App;
use Core\Database;  
use Core\function;

$db= App::resolve(Database::class);
// Load customers from DB for the dropdown
//$customers = $db->query("SELECT id, name FROM customers")->fetchAll();
// Optional: pass old input and errors for sticky form
$old = $_POST ?? [];
$errors = [];

$invoice_number = generateInvoiceNumber($db);
$customers = $db->query("SELECT id, name FROM customers")->fetchAll();
$products = $db->query("SELECT * FROM products")->fetchAll();

view('order/create.view.php', [
    'customers' => $customers,
    'products' => $products,
    'invoice_number' => $invoice_number,
    'old' => $_POST ?? [],
    'errors' => $errors ?? []
]);

?>