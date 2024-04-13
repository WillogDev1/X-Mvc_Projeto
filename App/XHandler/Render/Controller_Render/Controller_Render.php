<?php
namespace App\XHandler\Render\Controller_Render;


class Controller_Render
{
    public static function CONTROLLER_RENDER($COMPONENT, $ACTION)
    {

        if (is_array($COMPONENT)) {
            $CONTROLLER_NAMESPACE = implode('\\', $COMPONENT);
            $CONTROLLER_NAME = end($COMPONENT);
        } else {
            $CONTROLLER_NAMESPACE = $COMPONENT;
            $CONTROLLER_NAME = $COMPONENT;
        }
    
        $TRY_LOAD_CONTROLLER_AND_ACTION = "\\App\\Controller\\$CONTROLLER_NAMESPACE\\$CONTROLLER_NAME";
    
        if (!class_exists($TRY_LOAD_CONTROLLER_AND_ACTION)) {
            throw new \Exception("Controlador $TRY_LOAD_CONTROLLER_AND_ACTION não existe.");
        }
    
        $LOAD_CONTROLLER_ACTION = new $TRY_LOAD_CONTROLLER_AND_ACTION;
    
        if (!method_exists($LOAD_CONTROLLER_ACTION, $ACTION)) {
            throw new \Exception("Método $ACTION não encontrado na classe Controller: $CONTROLLER_NAME");
        }
    
        $LOAD_CONTROLLER_ACTION->$ACTION();
    }
}
?>