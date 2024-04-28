<?php
namespace App\Controller\Login;

use App\Model\Login\Login as LoginModel;

class Login
{
    public static function get()
    {

    }

    public static function loggin()
    {
        $user_Input_Is_Valid = Aux_Login::validate_User_Input_For_Login($_POST['username'], $_POST['password']);
        if($user_Input_Is_Valid)
        {
            LoginModel::loggin($user_Input_Is_Valid['username'], $user_Input_Is_Valid['password']);
        }
    }
}

?>