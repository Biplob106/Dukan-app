<?php 

use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
$employee = $db->query('SELECT * from employees where id = :id',[
    'id' => $_GET['id']

])->findOrFail();

view('employee/edit.view.php',[
    'heading' => 'Edit Employee',
    'employee' => $employee
]);