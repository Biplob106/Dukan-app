<?php 


use Core\Database;  
use Core\App;



$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);

 $customer = $db->query('select * from customers where id = :id', [
    'id' => $_GET['id']
])->findOrFail();


view('customer/edit.view.php',[
    'heading' => 'Edit Customer',
    'customer' => $customer
    
]);