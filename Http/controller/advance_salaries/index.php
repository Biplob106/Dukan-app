
<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$advance_salary =  $db->query("SELECT * FROM advance_salary  LEFT JOIN employees ON advance_salary.employee_id = employees.id")->fetchAll();


view('advance_salary/index.view.php',[
    'advance_salary' => $advance_salary
]);