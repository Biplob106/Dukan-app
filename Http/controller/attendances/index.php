
<?php
use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
$attendances = $db->query("SELECT * FROM attendances  LEFT JOIN employees ON attendances.employee_id = employees.id")->fetchAll();
view('attendance/index.view.php',
[
    'attendances' => $attendances
]
);