<?php

namespace App\Model\Home;

class Home
{
    public static function get()
    {
        // Implementação da função GET
        $DATA = str_replace('Home', __CLASS__, 'Home - Works');
        return $DATA;
    }

    public static function post()
    {
        // Implementação da função POST
    }
}

?>