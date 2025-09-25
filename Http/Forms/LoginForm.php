<?php
namespace Http\Forms;

use Core\Validation;

class LoginForm
{
    protected $errors = [];

    public function validate($email,$password)
    {

        
        if (! Validation::email($email)) {
            $this->errors['email'] = 'please provide a valid email address';
        }

        if (! Validation::string($password)) {

            $this->errors['password'] = 'please provide a password atleast seveen diggit';
        }

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field,$message)
    {
        $this->errors[$field] = $message;
    }

}