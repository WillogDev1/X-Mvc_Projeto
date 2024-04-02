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


    public static function routes()
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
    ];
    }
}
