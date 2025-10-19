<?php

use Core\App;
use Core\Database;
use Core\Validation;

// Get database instance
$db = App::resolve(Database::class);


//dd($_SESSION);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitize input
    $customer_id    = trim($_POST['customer_id'] ?? '');
    $sub_total      = floatval($_POST['sub_total'] ?? 0);
    $discount       = floatval($_POST['discount'] ?? 0);
    $delivery_date  = trim($_POST['delivery_date'] ?? null);
    $remarks        = trim($_POST['remarks'] ?? '');
    $user_id = $_SESSION['user']['id'] ?? null; // logged-in user
    
    // ✅ Generate unique invoice number
    
    $invoice_number = generateInvoiceNumber($db);
    // ✅ Validation
    if(!$customer_id)
    {
        $errors['customer_id']= "please select customer";
    }
    if($sub_total <= 0)
    {
        $errors['sub_total']= " sub total must be positive number ";
    }
    if($discount <0)
    {
        $errors['discount'] = "Discount cannot be negative.";
    }
    if(!$user_id)
    {
        $errors['user_id'] = "User id can not be null";
    }
    
    //Validation errors
    if (!empty($errors)) {
            return view('order/create.view.php', [
                    'heading' => 'Create Order',
                    'errors'  => $errors,
                    'old'     => [
                            'customer_id'   => $customer_id,
                            'sub_total'     => $sub_total,
                            'discount'      => $discount,
                            'delivery_date' => $delivery_date,
                            'remarks'       => $remarks,
                        ],
                        'invoice_number' => $invoice_number,
                    ]);
                }
                
                $grand_total = $sub_total - $discount;

                try {
                    $db->query(
                        "INSERT INTO orders (
            invoice_number, customer_id, sub_total, discount, grand_total,
            user_id, status, payment_status, created_at, delivery_date, remarks
        ) VALUES (
            :invoice_number, :customer_id, :sub_total, :discount, :grand_total,
            :user_id, 'pending', 'unpaid', NOW(), :delivery_date, :remarks
        )",
        [
            'invoice_number' => $invoice_number,
            'customer_id'    => $customer_id,
            'sub_total'      => $sub_total,
            'discount'       => $discount,
            'grand_total'    => $grand_total,
            'user_id'        => $user_id,
            'delivery_date'  => $delivery_date,
            'remarks'        => $remarks
            ]
        );
        
      header('location: /order');
      exit;
        
} catch (Throwable $e) {
    echo "<pre style='color:red'> Database Error: " . htmlspecialchars($e->getMessage()) . "</pre>";
    die;
}
}
