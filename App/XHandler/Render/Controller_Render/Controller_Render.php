<?php
namespace App\XHandler\Render\Controller_Render;


class Controller_Render
{
    public static function CONTROLLER_RENDER($COMPONENT, $ACTION)
    {
        $PATH_TO_CONTROLLER = self::CONTROLLER_PATH($COMPONENT);

        if (!class_exists($PATH_TO_CONTROLLER)) {
            throw new \Exception("Controlador $PATH_TO_CONTROLLER não existe.");
        }

        $REFLACTIONCLASS = new \ReflectionClass($PATH_TO_CONTROLLER);

        $CONSTRUCTOR = $REFLACTIONCLASS->getConstructor();

        $PARAMS = $CONSTRUCTOR->getParameters();

        $LOAD_CONTROLLER_ACTION = $REFLACTIONCLASS->newInstanceArgs($PARAMS);

        if (!method_exists($LOAD_CONTROLLER_ACTION, $ACTION)) {
            throw new \Exception("Método $ACTION não encontrado na classe Controller");
        }
        
        $LOAD_CONTROLLER_ACTION->$ACTION();
    }


    public static function CONTROLLER_PATH($PATH_CONTROLLER)
    {
        if (is_array($PATH_CONTROLLER)) {
            $CONTROLLER_NAMESPACE = implode('\\', $PATH_CONTROLLER);
            $CONTROLLER_NAME = end($PATH_CONTROLLER);
        } else {
            $CONTROLLER_NAMESPACE = $PATH_CONTROLLER;
            $CONTROLLER_NAME = $PATH_CONTROLLER;
        }

        return "\\App\\Controller\\$CONTROLLER_NAMESPACE\\$CONTROLLER_NAME";
    }
}
?>