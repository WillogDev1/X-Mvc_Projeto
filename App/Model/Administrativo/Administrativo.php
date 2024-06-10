<?php

namespace App\Model\Administrativo;

class Administrativo
{
    public static function pode_Visualizar_Administrativo()
    {
        // Implementação da função GET
        $DATA = str_replace('Administrativo', __CLASS__, 'Administrativo - Works');
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }
}