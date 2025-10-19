
<?php 

use Core\App;
use Core\Database;
use Core\Validation;
$db = App::resolve(Database::class);
$errors = [];


$id = $_POST['id'] ?? $_GET['id'] ?? null ;



if(!$id)
    {
        die('employee id is missing');
    }
    $employee = $db->query("SELECT * from employees where id = :id",[
    'id' => $id
    ])->find();
    if(!$employee)
        {
            die('employee not found ');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method']=== 'PATCH')
            {
                //  Sanitize input
                
    $name         = trim($_POST['name'] ?? '');
    $email        = trim($_POST['email'] ?? '');
    $phone        = trim($_POST['phone'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $date_of_birth = trim($_POST['date_of_birth'] ?? '');
    $nid_bc = trim($_POST['nid_bc'] ?? '');
    $date_of_joining = trim($_POST['date_of_joining'] ?? '');
    $salary	         = trim($_POST['salary'] ?? '');
    $night_salary    = trim($_POST['night_salary'] ?? '');
    $frequency = trim($_POST['frequency'] ?? '');
    $advance_salary  = trim($_POST['advance_salary'] ?? '');
    
    
    //validation 
    
    if(!Validation::string($name,2,100)){
        $errors['name'] = 'Employee name is required (2–100 characters).';
    }
    if(!Validation::email($email)){
        $errors['email'] = 'Employee valid email is required .';
    }
    if (! empty($address) && strlen($address) > 255) {
        $errors['address'] = 'Address is too long (max 255 characters).';
    }
    if (! empty($phone) && ! preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
        $errors['phone'] = 'Phone number must be 7–15 digits, optional + at start.';
    }
    if( $salary<0)
        {
            $errors['salary'] = 'salary not be negative ';
        }
        if($advance_salary<0){
            $errors['advance_salary'] = 'advance salary not be negative';
        }
        
        $valid_frequencies = ['monthly', 'weekly', 'daily'];
        if (!empty($frequency) && !in_array(strtolower($frequency), $valid_frequencies)) {
            $errors['frequency'] = 'Invalid salary frequency (use monthly, weekly, or daily).';
        }
        //  If there are validation errors, return to the form
        //dd($_POST);
        if(!empty($errors))
            {
                return view('employee/edit.view.php',[
                    'heading' => 'Edit Employee',
                    'errors' => $errors,
                    'old'    => [
                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone,
                        'address' => $address,
                        'date_of_birth' => $date_of_birth,
                        'nid_bc'   => $nid_bc,
                        'date_of_joining' => $date_of_joining,
                        'salary'          => $salary,
                        'night_salary'     => $night_salary,
                        'frequency'        => $frequency,
                        'advance_salary'    => $advance_salary
            ]
        ]);
    }

    //  Update in the database
    try {
        $db->query(
            "UPDATE employees 
             SET name = :name, 
                 email = :email, 
                 phone = :phone, 
                 address = :address, 
                 date_of_birth = :date_of_birth,
                 nid_bc = :nid_bc,
                 date_of_joining = :date_of_joining,
                 salary = :salary,
                 night_salary = :night_salary,
                 frequency = :frequency,
                 advance_salary = :advance_salary
             WHERE id = :id",
            [
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'date_of_birth' => $date_of_birth,
                'nid_bc' => $nid_bc,
                'date_of_joining' => $date_of_joining,
                'salary' => $salary,
                'night_salary' => $night_salary,
                'frequency'  => $frequency,
                'advance_salary' => $advance_salary

            ]
        );
    } catch (Exception $e) {
        die('Database update failed: ' . $e->getMessage());
    }

    //  Redirect back to employee list
    header('Location: /employee');
    exit;
}

//  Load the edit form
view('employee/edit.view.php', [
    'heading' => 'Edit employee',
    'employee' => $employee,
    'errors' => $errors
]);
