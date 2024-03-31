<?php 
namespace App\Controller\Login;

use App\Model\Login\Login as LoginModel;

class Login
{
    public static function get()
    {

    }

    public function post()
    {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        LoginModel::post($email, $senha);
    }
}

?>