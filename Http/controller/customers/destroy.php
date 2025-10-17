<?php 
use Core\App;
use Core\Database;  

$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);



    $customer = $db->query('select * from customers where id = :id', [
    'id' => $_POST['id']])->findOrFail();

    $db->query('delete from customers where id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /customer');
    exit;