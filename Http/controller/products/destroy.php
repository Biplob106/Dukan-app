<?php 
use Core\App;
use Core\Database;  

$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);



    $note = $db->query('select * from products where id = :id', [
    'id' => $_POST['id']])->findOrFail();

    $db->query('delete from products where id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /product');
    exit;