<?php

namespace App\Controller\Administrativo\Almoxarifado;

use App\Model\Administrativo\Almoxarifado\Almoxarifado as AlmoxarifadoModel;

class Almoxarifado
{

    public function __construct()
    {
        
    }
    public static function get()
    {
        // Implementação da função GET
        
    }

    public static function post()
    {
        // Implementação da função POST
        AlmoxarifadoModel::post();
    }
}