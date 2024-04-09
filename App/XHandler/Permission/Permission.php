<?php

namespace App\XHandler\Permission;


class Permission
{
    public static function USER_VALIDATE_IF_USER_HAS_PERMISSIONS($USER_PERMISSION, $ROUTES_PERMISSION, $METHOD)
    {
        /*

        Se Usuario tem TRUE para GET na Pagina requisitada, ele pode visualizar


            $USER_PERMISSION [
                "/admin" => [
                    "GET"       => "1"
                    "PUT"       => "1"
                    "EDIT"      => "1"
                    "DELETE"    => "0"
                ]
            ]

        */
    }

    public static function RETURN_USER_PERMISSIONS()
    {
        return 
        [
            "" => ""
        ];
    }
}
