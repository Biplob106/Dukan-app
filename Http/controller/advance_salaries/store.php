<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$errors = [];

if($_SERVER['REQUEST_METHOD']==='POST')
{
$employee_id = trim($_POST['employee_id'] ?? '');
$amount = trim($_POST['amount'] ?? '');
$remarks = trim($_POST['remarks'] ?? '');
$created_at = trim($_POST['created_at'] ?? date('Y-m-d'));



//validation
if(!$employee_id){

    $errors['employee'] = 'Please select a employee' ;
}
if($amount <0){
    $errors['amount'] = 'amount not be negative number';
}

if(!empty($errors)){
    
         $employees = $db->query("SELECT id, name FROM employees")->fetchAll();
            return view('attendance/create.view.php', [
                'employees' => $employees,
                'errors' => $errors,
                'old' => $_POST
            ]);
}

$db->query(
    " INSERT INTO advance_salary ( employee_id ,amount,remarks, created_at) 
    VALUES( :employee_id, :amount, :remarks , :created_at)",
    [
        'employee_id' => $employee_id,
        'amount' => $amount,
        'remarks' => $remarks,
        'created_at' => $created_at
    ]
    );


    header('location: /advance_salary');


    }