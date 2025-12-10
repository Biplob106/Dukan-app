<?php 
use Core\App;
use Core\Database;  

$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);



    $attendance = $db->query('SELECT * from attendances where id = :id', [
    'id' => $_POST['id']])->findOrFail();

    $db->query('DELETE  FROM attendances WHERE id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /attendance');
    exit;