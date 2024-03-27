<?php
namespace App\Handlers\Routes;

class Routes
{
    public static function routes()
    {
        return[
            "/" => [
                "GET" => "Login@index"
            ],
            "/login" =>[
                "GET" => "Login@index",
                "POST" => "Login@AuthLogin"
            ],
            "/home" =>[
                "GET" => "Home@index"
            ]
        ];   
    }
}

?>