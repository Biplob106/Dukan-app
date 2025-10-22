<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$employees = $db->query("SELECT * from employees")->fetchAll();
view('advance_salary/create.view.php',[
    'employees' => $employees
]);