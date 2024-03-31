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


    public function verifiy_email($email)
    {
    // Verifica se o e-mail tem um formato válido usando uma expressão regular
    $isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

    // Retorna true se o e-mail for válido e false caso contrário
    return $isValidEmail !== false;
    }
}

?>