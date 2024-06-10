<?php

namespace  App\XHandler\Router\Routes;

class Routes
{
    private array $PROTECTED_ROUTES;
    private array $PROTECTED_FREE_ROUTES;
    private array $FREE_ROUTES;

    public function __construct()
    {
        $this->PROTECTED_ROUTES         = self::ROUTES();
        $this->PROTECTED_FREE_ROUTES    = self::ROUTES_THAT_DONT_NEED_PERMISSION();
        $this->FREE_ROUTES              = self::ROUTES_THAT_DONT_NEED_LOGGIN();
    }

    // Getters
    public function getProtectedRoutes(): array
    {
        return $this->PROTECTED_ROUTES;
    }

    public function getProtectedFreeRoutes(): array
    {
        return $this->PROTECTED_FREE_ROUTES;
    }

    public function getFreeRoutes(): array
    {
        return $this->FREE_ROUTES;
    }

    private function ROUTES_THAT_DONT_NEED_LOGGIN()
    {
        return [
            "/" => "",
            "/login" => "login",
            "/page-not-found" => "PageNotFound"
        ];
    }

    private function ROUTES_THAT_DONT_NEED_PERMISSION()
    {
        return [
            "/" => "",
            "/login" => "login",
            "/home" => "home",
            "/perfil" => "perfil",
            "/administrativo/almoxarifado" => "administrativo",
            "/login/recoveraccess" => "login",
            "/login/firstaccess" => "login"
        ];
    }

    private function ROUTES()
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
    
            "/administrativo/almoxarifado" => [
                "GET" => [
                    "Controller" => "Administrativo/Almoxarifado@get",
                ],
                "POST" => [
                    "Controller" => "Administrativo/Almoxarifado@post",
                ],
            ],
    ];
    }
}
