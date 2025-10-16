<?php

use Core\Database;
use Core\Validation;
use Core\App;

//  Get the database instance
$db = App::resolve(Database::class);

$errors = [];

// Get product ID from POST or GET
$id = $_POST['id'] ?? $_GET['id'] ?? null;

if (!$id) {
    die('Product ID is missing.');
}

//  Fetch the existing product
$product = $db->query("SELECT * FROM products WHERE id = :id", ['id' => $id])->find();

if (!$product) {
    die('Product not found.');
}

//  Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['_method'] ?? '') === 'PATCH') {

    // 🧹 Sanitize input
    $name = trim($_POST['name'] ?? '');
    $size = trim($_POST['size'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $color = trim($_POST['color'] ?? '');
    $material = trim($_POST['material'] ?? '');

    //  Validate inputs
    if (!Validation::string($name, 2, 100)) {
        $errors['name'] = 'Product name is required (2–100 characters).';
    }
    if (!Validation::string($size, 1, 50)) {
        $errors['size'] = 'Size is required (max 50 characters).';
    }
    if (!Validation::string($description, 5, 255)) {
        $errors['description'] = 'Description must be 5–255 characters long.';
    }
    if (!is_numeric($price) || $price <= 0) {
        $errors['price'] = 'Price must be a positive number.';
    }
    if (!Validation::string($color, 2, 100)) {
        $errors['color'] = 'Color must be 2–100 characters long.';
    }
    if (!Validation::string($material, 2, 100)) {
        $errors['material'] = 'Material must be 2–100 characters long.';
    }

    //  If validation fails → reload form with errors
    if (!empty($errors)) {
        return view('product/edit.view.php', [
            'heading' => 'Edit Product',
            'errors' => $errors,
            'product' => $product,
            'old' => [
                'name' => $name,
                'size' => $size,
                'description' => $description,
                'price' => $price,
                'color' => $color,
                'material' => $material
            ]
        ]);
    }

    //  Update in the database
    try {
        $db->query(
            "UPDATE products 
             SET name = :name, 
                 size = :size, 
                 description = :description, 
                 price = :price, 
                 color = :color, 
                 material = :material
             WHERE id = :id",
            [
                'id' => $id,
                'name' => $name,
                'size' => $size,
                'description' => $description,
                'price' => $price,
                'color' => $color,
                'material' => $material
            ]
        );
    } catch (Exception $e) {
        die('Database update failed: ' . $e->getMessage());
    }

    //  Redirect back to product list
    header('Location: /product');
    exit;
}

//  Load the edit form
view('product/edit.view.php', [
    'heading' => 'Edit Product',
    'product' => $product,
    'errors' => $errors
]);