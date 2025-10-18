<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

// Fetch all products
$images = $db->query("SELECT * FROM images ORDER BY id ASC")->fetchAll();

// Pass to view
view('image/index.view.php', [
    'heading' => 'All images',
    'images' => $images
]);