<?php
namespace App\XHandler\Access;

class Access
{
    public static function ACCESS()
    {
        self::START_SESSION();

        return self::VERIFY_USER_IS_LOGIN();

    }

    public static function START_SESSION()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
          }
    }


    public static function VERIFY_USER_IS_LOGIN()
    {
        return isset($_SESSION['SESSION_ID']);
    }

    public static function ERROR_PAGE() // TODO: Criar em Router uma pagina de erro que serve diversas dependendo do erro
    {
        header("Location: /user-not-logging");
        exit();
    }

    
}


?>