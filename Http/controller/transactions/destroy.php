
<?php 
use Core\App;
use Core\Database;  

$db= App::resolve(Database::class);
//$id=$_GET['id'];
//var_dump($id);



    $transaction = $db->query('select * from transactions where id = :id', [
    'id' => $_POST['id']])->findOrFail();

    $db->query('delete from transactions where id = :id', [
        'id' => $_POST['id']
    ]);

    header('location: /transaction');
    exit;