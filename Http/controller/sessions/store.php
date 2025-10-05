<?php
// Start session at the very top
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

// Get POST data safely
$email    = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Create the form object
$form = new LoginForm();

// Step 1: Validate input
if ($form->validate($email, $password)) {

    $auth = new Authenticator();

    // Step 2: Attempt login
    if ($auth->attempt($email, $password)) {
        // Login success
        redirect('/'); // Home page
        exit;
    } else {
        // Authentication failed
        $form->error('email', 'No matching account found for this email or password.');
    }

} 

// Step 3: Flash errors and old input
Session::flash('errors', $form->errors());
Session::flash('old', ['email' => $email]);

// Optional debug - uncomment while testing
/*
var_dump($email);
var_dump($password);
var_dump($form->errors());
exit;
*/

// Step 4: Redirect back to login
redirect('/login');
exit;