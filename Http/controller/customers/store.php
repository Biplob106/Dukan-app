<?php

use Core\App;
use Core\Database;
use Core\Validation;

//  Get the database instance
$db = App::resolve(Database::class);

$errors = [];

//dected ajax request
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //  Sanitize input
    $name         = trim($_POST['name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $total_amount = trim($_POST['total_amount'] ?? '');
    $paid_amount = trim($_POST['paid_amount'] ?? '');
    $discount_amount = trim($_POST['discount_amount'] ?? '');
    $due_amount  = $total_amount - ($paid_amount+$discount_amount);
    //var_dump($name);
    // ✅ Validate inputs
    if (! Validation::string($name, 2, 100)) {
        $errors['name'] = 'Product name is required (2–100 characters).';
    }

// Phone (optional, digits only, 7–15 characters)
    if (! empty($phone) && ! preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
        $errors['phone'] = 'Phone number must be 7–15 digits, optional + at start.';
    }

// Address (optional, max length 255)
    if (! empty($address) && strlen($address) > 255) {
        $errors['address'] = 'Address is too long (max 255 characters).';
    }

    if (! is_numeric($total_amount) || $total_amount <= 0) {
        $errors['total_amount'] = 'total amount must be a positive number.';
    }
    if (! is_numeric($due_amount) || $due_amount <= 0) {
        $errors['due_amount'] = 'due must be a positive number.';
    }
    if (! is_numeric($paid_amount) || $paid_amount <= 0) {
        $errors['paid_amount'] = 'paid must be a positive number.';
    }
    if (! is_numeric($discount_amount) || $discount_amount <= 0) {
        $errors['discount_amount'] = 'discount must be a positive number.';
    }

    //  If there are validation errors, return to the form
    if (! empty($errors)) {

        if ($isAjax) {
            header('Content-Type: application/json');
            echo json_encode(['errors' => $errors]);
            exit;
        }else {
        return view('customer/create.view.php', [
            'heading' => 'Create Customer',
            'errors'  => $errors,
            'old'     => [
                'name'            => $name,
                'email'           => $email,
                'phone'           => $phone,
                'address'         => $address,
                'total_amount'    => $total_amount,
                'due_amount'      => $due_amount,
                'paid_amount'     => $paid_amount,
                'discount_amount' => $discount_amount,
            ],
        ]);
    }
}

    //  Insert into the database
    $db->query(
        "INSERT INTO customers (name, email, phone,  address,total_amount, due_amount, paid_amount, discount_amount)
         VALUES (:name, :email, :phone, :address, :total_amount , :due_amount, :paid_amount , :discount_amount)",
        [
            'name'            => $name,
            'email'           => $email,
            'address'         => $address,
            'phone'           => $phone,
            'total_amount'    => $total_amount,
            'due_amount'      => $due_amount,
            'paid_amount'     => $paid_amount,
            'discount_amount' => $discount_amount,

        ]
    );

$customerId = $db->lastInsertId();

    // 🔁 Redirect to product list page
    if($isAjax) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true
            ,'customer_id' => $customerId,
            'name' => $name
        ]);
        exit;
    }else {
    header('Location: /customer');
    exit;
}
}