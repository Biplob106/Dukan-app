
<?php 
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$errors = [];

if($_SERVER['REQUEST_METHOD']=== 'POST')
{

    $employee_id    = trim($_POST['employee_id'] ?? '');
    $attendance_date = trim($_POST['attendance_date'] ?? date('Y-m-d'));
    $is_present      = isset($_POST['is_present']) ? 1 : 0;
    $is_night        = isset($_POST['is_night']) ? 1 : 0;
    $is_paid         = isset($_POST['is_paid']) ? 1 : 0;


    if(!$employee_id)
    {
         $errors['employee_id'] = 'Please select an employee.';
    }
    if(!$attendance_date)
    {
        $errors['attendance_date'] = 'Please put a date .';
    }

    if(!empty($errors))
    {

         $employees = $db->query("SELECT id, name FROM employees")->fetchAll();
            return view('attendance/create.view.php', [
                'employees' => $employees,
                'errors' => $errors,
                'old' => $_POST
            ]);
    }

     $db->query(
            "INSERT INTO attendances (employee_id, attendance_date, is_present, is_night, is_paid)
             VALUES (:employee_id, :attendance_date, :is_present, :is_night, :is_paid)",
            [
                'employee_id' => $employee_id,
                'attendance_date' => $attendance_date,
                'is_present' => $is_present,
                'is_night' => $is_night,
                'is_paid' => $is_paid
            ]
        );

        // Redirect to the attendance list or success page
        header('Location: /attendance');
        exit;
}