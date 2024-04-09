<?php
namespace App\XHandler\Render\Controller_Render;


class Controller_Render
{
    public static function CONTROLLER_RENDER($CONTROLLER, $ACTION)
    {
        $TRY_LOAD_CONTROLLER_AND_ACTION = "\\App\\Controller\\$CONTROLLER\\$CONTROLLER";

        if (!class_exists($TRY_LOAD_CONTROLLER_AND_ACTION))
        {
            throw new \Exception("Controlador $CONTROLLER não existe.");
        }

        $LOAD_CONTROLLER_ACTION = new $TRY_LOAD_CONTROLLER_AND_ACTION;

        if (!method_exists($LOAD_CONTROLLER_ACTION, $ACTION))
        {
            throw new \Exception("Nétodo $ACTION não encontrado na classe $CONTROLLER");
        }

        $LOAD_CONTROLLER_ACTION->$ACTION();

    }
}
?>