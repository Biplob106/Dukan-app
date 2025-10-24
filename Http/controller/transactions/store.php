
<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];
if($_SERVER['REQUEST_METHOD']==='POST')
{
     $customer_id   = trim($_POST['customer_id'] ?? '');
    $order_id    = trim($_POST['product_id'] ?? '');
    $amount      = floatval($_POST['amount'] ?? 0);
    $method = trim($_POST['method'] ?? '');
    $created_at =trim($_POST['created_at'] ?? '');
   

        // --- Validation ---
    if (!$customer_id) $errors['customer_id'] = "Please select a customer.";
    if (!$order_id)  $errors['order_id']  = "Please select a order id .";

    if (!empty($errors)) {
        return view('transaction/create.view.php', [
            'heading' => 'Create transaction',
            'errors'  => $errors,
            'customers' => $db->query("SELECT * FROM customers")->fetchAll(),
            'orders'  => $db->query("SELECT * FROM orders")->fetchAll(),
        ]);
    }

    //  Insert into transactions
        $db->query("
            INSERT INTO transactions (
                 customer_id, order_id , amount, method ,created_at
            ) VALUES (
                :customer_id, :order_id, :amount, :method, :created_at
            )
        ", [
            'customer_id'    => $customer_id,
            'order_id'      => $order_id,
            'amount'    => $amount,
            'method'        => $method,
            'created_at' => $created_at
           
        ]);


        header('location: /transaction');
exit;


}