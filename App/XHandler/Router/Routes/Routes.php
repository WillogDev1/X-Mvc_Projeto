<?php

namespace  App\XHandler\Router\Routes;

class Routes
{
    public static function routes()
    {
        return [
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
        ];
    }
}
