 <?php

use Core\App;
use Core\Database;
use Core\Validation;

//  Get the database instance
$db = App::resolve(Database::class);

$errors = [];

// Get customer ID from POST or GET
$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    die('customer ID is missing.');
}
//  Fetch the existing customer
$customer = $db->query("SELECT * FROM customers WHERE id = :id", ['id' => $id])->find();

if (!$customer) {
    die('customer not found.');
}

//  Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PATCH') {

    //  Sanitize input
    $name         = trim($_POST['name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $total_amount = trim($_POST['total_amount'] ?? '');
    $paid_amount = trim($_POST['paid_amount'] ?? '');
    $due_amount  = trim($_POST['due_amount'] ?? '');
    $discount_amount = trim($_POST['discount_amount'] ?? '');
    //var_dump($name);
    //  Validate inputs
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
        return view('customer/edit.view.php', [
            'heading' => 'Edit Customer',
            'errors'  => $errors,
            'old'     => [
                'name'            => $name,
                'email'           => $email,
                'phone'           => $phone,
                'address'         => $address,
                'total_amount'    => $total_amount,
                'due_amount'      => $due_amount,
                'paid_amount'     => $paid_amount,
                'discount_amount' => $discount_amount
            ],
        ]);
    }
 //  Update in the database
    try {
        $db->query(
            "UPDATE customers  
             SET name = :name, 
                 email = :email, 
                 phone = :phone, 
                 address = :address, 
                 total_amount = :total_amount,
                 due_amount = :due_amount,
                 paid_amount = :paid_amount,
                 discount_amount = :discount_amount
             WHERE id = :id",
            [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'total_amount' => $total_amount,
                'due_amount' => $due_amount,
                'paid_amount' => $paid_amount,
                'discount_amount' => $discount_amount
            ]
        );
    } catch (Exception $e) {
        die('Database update failed: ' . $e->getMessage());
    }

    //  Redirect back to product list
    header('Location: /customer');
    exit;
}

   

//  Load the edit form
view('customer/edit.view.php', [
    'heading' => 'Edit customer',
    'customer' => $customer,
    'errors' => $errors
]);