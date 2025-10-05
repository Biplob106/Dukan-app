<?php
use Core\App;
use Core\Database;
use Http\Forms\LoginForm;
require_once base_path('Core/App.php');
require_once base_path('Core/Database.php');

//session_start();

$db = App::resolve(Database::class);

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$form = new LoginForm;
$errors = [];
if (! $form->validate($email, $password)) {
    $errors = $form->errors ?? [];
    return view('registration/create.view.php', [
        'errors' => $errors,
    ]);
}

// Check if user already exists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email,
])->find();

if ($user) {
    header('Location: /login');
    exit;
}

// Insert new user
$db->query(
    'INSERT INTO users(name, email, password) VALUES(:name, :email, :password)',
    [
        'name' => $name,
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