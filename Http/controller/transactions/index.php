
<?php
use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
//$transactions = $db->query("SELECT * FROM transactions JOIN customers ON transactions.customer_id = customers.id
//JOIN orders ON transactions.order_id = orders.id  ")->fetchAll();

$transactions = $db->query("
    SELECT transactions.id, transactions.amount, transactions.method, transactions.created_at,
           customers.name, orders.invoice_number, orders.grand_total,orders.id AS order_id
    FROM transactions
    LEFT JOIN customers ON transactions.customer_id = customers.id
    LEFT JOIN orders ON transactions.order_id = orders.id
    ORDER BY transactions.created_at DESC
")->fetchAll();

view('transaction/index.view.php',[
    'transactions' => $transactions
]);