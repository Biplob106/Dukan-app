<?php


namespace Http\Forms;

use Core\Validation;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password)
    {
        if (!Validation::email($email)) {
            $this->errors['email'] = 'Please provide a valid email address';
        }

        if (!Validation::string($password) || strlen($password) < 4) {
            $this->errors['password'] = 'Please provide a password of at least seven characters';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}