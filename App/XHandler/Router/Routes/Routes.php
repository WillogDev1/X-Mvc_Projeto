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
                    "Controller" => "Login@get"
                ],
                "POST" => [
                    "Controller" => "Login@post"
                ]
            ],

            "/home" => [
                "GET" => [
                    "Controller" => "Home@get",
                ],
            ],
        
            "/perfil" => [
                "GET" => [
                    "Controller" => "Perfil@get",
                ],
                "POST" => [
                    "Controller" => "Perfil@post",
                ],
            ],

            "/perfil/userperfil" => [
                "GET" => [
                    "Controller" => "Perfil/UserPerfil@geting",
                ],
                "POST" => [
                    "Controller" => "Perfil@post",
                ],
            ],

    
            "/admin" => [
                "GET" => [
                    "Controller" => "Admin@get",
                ],
                "POST" => [
                    "Controller" => "Admin@post",
                ],
            ],
    ];
    }
}
