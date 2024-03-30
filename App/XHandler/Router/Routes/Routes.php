<?php

namespace  App\XHandeler\Router\Routes;

class Router
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
        ];
    }
}
