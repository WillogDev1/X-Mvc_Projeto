<?php 
namespace App\Model\Login;

class Login
{
    public static function get()
    {
        $DATA = "Login - Works!";
        return $DATA;
    }

    public static function post($email, $senha)
    {
        if($email === "william" && $senha === "123")
        {
            //session_start();
            $_SESSION['SESSION_ID'] = '10';
            header("Location: /home");
        }else{
            echo "Não Acessou";
        }
    }
}

?>