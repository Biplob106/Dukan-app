<?php

use Core\Database;
use Core\Validation;
use Core\App;

// 🔒 Check if user is logged in


// 💾 Get the database instance
$db = App::resolve(Database::class);

$errors = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🧹 Sanitize input
    $name = trim($_POST['name'] ?? '');
    $size = trim($_POST['size'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $color = trim($_POST['color'] ?? '');
    $material = trim ($_POST['material'] ?? '');

    //var_dump($name);

    // ✅ Validate inputs
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
        $errors['color'] = 'Description must be 2–100 characters long.';
    }
 if (!Validation::string($material, 2, 100)) {
        $errors['material'] = 'materials must be 2–100 characters long.';
    }


    //  If there are validation errors, return to the form
    if (!empty($errors)) {
        return view('product/create.view.php', [
            'heading' => 'Create Product',
            'errors' => $errors,
            'old' => [
                'name' => $name,
                'size' => $size,
                'description' => $description,
                'price' => $price,
                'color'=> $color,
                'material' => $material
            ]
        ]);
    }

    // 💾 Insert into the database
    $db->query(
        "INSERT INTO products (name, size, description, price, color, material)
         VALUES (:name, :size, :description, :price , :color, :material)",
        [
            'name' => $name,
            'size' => $size,
            'description' => $description,
            'price' => $price,
            'color'=> $color,
            'material' => $material
            
        ]
    );

    // 🔁 Redirect to product list page
    header('Location: /product');
    exit;
}