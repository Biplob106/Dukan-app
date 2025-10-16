<?php 


use Core\Database;  
use Core\App;



$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);

 $product = $db->query('select * from products where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


view('product/edit.view.php',[
    'heading' => 'Edit product',
    'product' => $product
    
]);