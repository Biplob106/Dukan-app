
<?php 

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
// Fetch all products
$orders = $db->query("SELECT  o. *, u.email AS user_email, c.name AS customer_name FROM orders o LEFT JOIN users u ON o.user_id = u.id
LEFT JOIN customers c ON o.customer_id = c.id ORDER BY o.id ASC")->fetchAll();

// Pass to view
view('order/index.view.php', [
    'heading' => 'All Orders',
    'orders' => $orders
]);
