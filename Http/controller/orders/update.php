<?php

use Core\App;
use Core\Authenticator;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PATCH') {
    //dd($_POST);

    $order_id = $_POST['id'] ?? null;
    $customer_id = trim($_POST['customer_id'] ?? '');
    $discount = floatval($_POST['discount'] ?? 0);
    $delivery_date = trim($_POST['delivery_date'] ?? '');
    $remarks = trim($_POST['remarks'] ?? '');
    $user_id = $_SESSION['user']['id'] ?? null;
    $product_id = trim($_POST['product_id'] ?? '');
    //$invoic_number = generateInvoiceNumber($db);


    //validation 
    if (!$customer_id) {
        $errors['customer_id'] = "please enter a customer id ";
    }

    if ($discount < 0) {
        $errors['discount'] = " discount can not be negative";
    }
    if (!$user_id) {
        $errors['user_id'] =  " please login first before create order ";
    }
    if (!empty($errors)) {
        return view('order/edit.view.php', [
            'heading' => 'Create Order',
            'errors' => $errors,
            'customers' => $db->query("SELECT * FROM customers ")->fetchAll(),
            'products' => $db->query("SELECT * FROM products")->fetchAll(),

        ]);
    }

    $product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $product_id])->find();

    if (!$product) {

        throw new Exception("product noty found");
    }
    $sub_total = floatval($product['price']);
    $grand_total = $sub_total - $discount;
    try {
        //  Correct UPDATE query
        $db->query(
            "UPDATE orders 
             SET customer_id    = :customer_id,
              
                 sub_total      = :sub_total,
                 discount       = :discount,
                 grand_total    = :grand_total,
                 user_id        = :user_id,
                 status         = 'pending',
                 payment_status = 'unpaid',
                 delivery_date  = :delivery_date,
                 remarks        = :remarks
                 
             WHERE id = :id",
            [
                'customer_id'   => $customer_id,

                'sub_total'     => $sub_total,
                'discount'      => $discount,
                'grand_total'   => $grand_total,
                'user_id'       => $user_id,
                'delivery_date' => $delivery_date,
                'remarks'       => $remarks,
                'id'            => $order_id,
            ]
        );



        $db->query(
            "UPDATE order_details
     SET product_id = :product_id,
         remarks    = :remarks,
         price      = :price,
         color      = :color,
         material   = :material,
         size       = :size,
         discount   = :discount
     WHERE order_id = :order_id",
            [
                'product_id' => $product_id,
                'remarks'    => $remarks,
                'price'      => $product['price'],
                'color'      => $product['color'],
                'material'   => $product['material'],
                'size'       => $product['size'],
                'discount'   => $discount,
                'order_id'   => $order_id
            ]
        );

        header('Location: /order');
        exit();
    } catch (Throwable $e) {
        echo "<pre style='color:red'>Database Error: " . htmlspecialchars($e->getMessage()) . "</pre>";
        die;
    }
}
