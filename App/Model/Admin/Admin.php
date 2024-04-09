<?php

namespace App\Model\Admin;

class Admin
{
    public static function get()
    {
        // Implementação da função GET
        $DATA = str_replace('Admin', __CLASS__, 'Admin - Works');
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }

}

?>