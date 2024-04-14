<?php

namespace App\Controller\Perfil\UserPerfil\UserInfo;

use App\Model\Perfil\UserPerfil\UserInfo\UserInfo as UserInfoModel;

class UserInfo
{
    public static function get()
    {
        // Implementação da função GET
        echo "Teste";
    }

    public static function post()
    {
        // Implementação da função POST
        UserInfoModel::post();
    }
}

?>