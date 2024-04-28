<?php

namespace App\Controller\Administrativo;

use App\Model\Administrativo\Administrativo as AdministrativoModel;

class Administrativo
{
    public static function pode_Visualizar_Administrativo()
    {
        // Implementação da função GET
    }

    public static function post()
    {
        // Implementação da função POST
        AdministrativoModel::post();
    }
}

?>