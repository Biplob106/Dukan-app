<?php
namespace Core;

class Authenticator
{
    protected $user;

   public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)
            ->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

            if ($user && password_verify($password, $user['password'])) {
                 $this->user = $user; // store user internally
            $this->login($user); // store ID and email in session
            return true;
            }
        

        return false;
    }
    // public function login($user)
    // {

    //     $_SESSION['user'] = [
    //         'email' => $user['email']

    //     ];
    // }

    public function login($user)
{
    $_SESSION['user'] = [
        'id'    => $user['id'],   // ✅ save user ID
        'email' => $user['email'] // keep email
    ];
}

    public function logout()
    {
        Session::destroy();
    }
    public function user()
{
    return $this->user; // return the authenticated user
}


}