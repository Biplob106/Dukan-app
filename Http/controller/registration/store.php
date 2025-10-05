<?php
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;


//session_start();

$db = App::resolve(Database::class);

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$form = new LoginForm;
$errors = [];
if (! $form->validate($email, $password)) {
    $errors = $form->errors ?? [];
    echo  view('registration/create.view.php', [
        'errors' => $errors,
    ]);
}

// Check if user already exists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email,
])->find();

if ($user) {
    echo 'email address alread exits';
    exit;
}

// Insert new user
$db->query(
    'INSERT INTO users( email, password) VALUES(:email, :password)',
    [
        
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]
);

// Fetch inserted user
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email,
])->find();

// Log in user
$_SESSION['user_id'] = $user->id;

header('Location: /login');
exit;