
<?php 
use Core\App;
use Core\Database;  

$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);



    $employee = $db->query('select * from employees where id = :id', [
    'id' => $_POST['id']])->findOrFail();

    $db->query('delete from employees where id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /employee');
    exit;