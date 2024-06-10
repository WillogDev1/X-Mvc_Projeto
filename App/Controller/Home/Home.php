<?php

namespace App\Controller\Home;

use App\Model\Home\Home as HomeModel;

class Home
{
    function __construct(){
        
    }

    public static function pode_Visualizar_Home()
    {

    }

    public static function post()
    {
        // Implementação da função POST
        HomeModel::post();
    }
}