<?php

namespace  App\XHandler\Router\Routes;

class Routes
{

    public static function ROUTES_THAT_DONT_NEED_LOGGIN()
    {
        return [
            "/" => "",
            "/login" => "login"
        ];
    }


    public static function ROUTES() // Adicionar um @ a mais se possivel, ou um "Permissao_ID" => "1"
    {
        return [
            "/page-not-found" => [
                "GET" => [
                    "Controller" => "PageNotFound@get",
                ],
            ],

            "/user-not-logging" => [
                "GET" => [
                    "Controller" => "UserNotLogging@get",
                ],
            ],

            "/" => [
                "GET" => [
                    "Controller" => "Login@get",
                ],
            ],
            
            "/login" => [
                "GET" => [
                    "Controller" => "Login@get",
                ],
                "POST" => [
                    "Controller" => "Login@loggin",
                ],
            ],
    
            "/home" => [
                "GET" => [
                    "Controller" => "Home@pode_Visualizar_Home",
                ],
                "POST" => [
                    "Controller" => "Home@post",
                ],
            ],
    
            "/administrativo" => [
                "GET" => [
                    "Controller" => "Administrativo@pode_Visualizar_Administrativo",
                ],
                "POST" => [
                    "Controller" => "Administrativo@post",
                ],
            ],
    ];
    }
}
