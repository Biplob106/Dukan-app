
<?php

use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
$employees = $db->query("SELECT * from employees ORDER BY id  ")->fetchAll();

view('employee/index.view.php',[
    'heading' => ' Add employee',
    'employees' => $employees
]);