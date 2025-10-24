<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $customer_id   = trim($_POST['customer_id'] ?? '');
    $product_id    = trim($_POST['product_id'] ?? '');
    $discount      = floatval($_POST['discount'] ?? 0);
    $delivery_date = trim($_POST['delivery_date'] ?? '');
    $remarks       = trim($_POST['remarks'] ?? '');
    $user_id       = $_SESSION['user']['id'] ?? null;

    // --- Validation ---
    if (!$customer_id) $errors['customer_id'] = "Please select a customer.";
    if (!$product_id)  $errors['product_id']  = "Please select a product.";
    if (!$user_id)     $errors['user_id']     = "User not logged in.";

    if (!empty($errors)) {
        return view('order/create.view.php', [
            'heading' => 'Create Order',
            'errors'  => $errors,
            'customers' => $db->query("SELECT * FROM customers")->fetchAll(),
            'products'  => $db->query("SELECT * FROM products")->fetchAll(),
        ]);
    }

    // Generate invoice number
    $invoice_number = 'INV-' . time();

    try {
        $db->beginTransaction();

        //  Get product data (for order_details + subtotal)
        $product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $product_id])->find();

        if (!$product) {
            throw new Exception("Product not found.");
        }

        $sub_total   = floatval($product['price']);
        $grand_total = $sub_total - $discount;

        //  Insert into orders
        $db->query("
            INSERT INTO orders (
                invoice_number, customer_id, sub_total, discount, grand_total,
                user_id, status, payment_status, created_at, delivery_date, remarks
            ) VALUES (
                :invoice_number, :customer_id, :sub_total, :discount, :grand_total,
                :user_id, 'pending', 'unpaid', NOW(), :delivery_date, :remarks
            )
        ", [
            'invoice_number' => $invoice_number,
            'customer_id'    => $customer_id,
            'sub_total'      => $sub_total,
            'discount'       => $discount,
            'grand_total'    => $grand_total,
            'user_id'        => $user_id,
            'delivery_date'  => $delivery_date,
            'remarks'        => $remarks,
        ]);

        $order_id = $db->lastInsertId();

        // Insert into order_details
        $db->query("
            INSERT INTO order_details (
                order_id, product_id, remarks, price, color, material, size, discount
            ) VALUES (
                :order_id, :product_id, :remarks, :price, :color, :material, :size, :discount
            )
        ", [
            'order_id'  => $order_id,
            'product_id'=> $product_id,
            'remarks'   => $remarks,
            'price'     => $product['price'],
            'color'     => $product['color'],
            'material'  => $product['material'],
            'size'      => $product['size'],
            'discount'  => $discount
        ]);

        $db->commit();

        header('Location: /order');
        exit;

    } catch (Throwable $e) {
        $db->rollback();
        echo "<pre style='color:red'>Database Error: " . htmlspecialchars($e->getMessage()) . "</pre>";
        die;
    }
}
