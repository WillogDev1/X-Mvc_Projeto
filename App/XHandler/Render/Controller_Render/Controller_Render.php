<?php
namespace App\XHandler\Render\Controller_Render;


class Controller_Render // ALTERADO VALIDAR ANTES DO COMMIT
{
    public static function CONTROLLER_RENDER($COMPONENT, $ACTION)
    {
        // Transforma o componente em string se for um array
        if (is_array($COMPONENT)) {
            $CONTROLLER_NAMESPACE = implode('\\', $COMPONENT);
            $CONTROLLER_NAME = end($COMPONENT);
        } else {
            $CONTROLLER_NAMESPACE = $COMPONENT;
            $CONTROLLER_NAME = $COMPONENT;
        }
    
        // Tenta carregar o controlador
        $TRY_LOAD_CONTROLLER_AND_ACTION = "\\App\\Controller\\$CONTROLLER_NAMESPACE\\$CONTROLLER_NAME";
    
        if (!class_exists($TRY_LOAD_CONTROLLER_AND_ACTION)) {
            throw new \Exception("Controlador $TRY_LOAD_CONTROLLER_AND_ACTION não existe.");
        }
    
        // Instancia o controlador e executa a ação
        $LOAD_CONTROLLER_ACTION = new $TRY_LOAD_CONTROLLER_AND_ACTION;
    
        if (!method_exists($LOAD_CONTROLLER_ACTION, $ACTION)) {
            throw new \Exception("Método $ACTION não encontrado na classe Controller: $CONTROLLER_NAME");
        }
    
        $LOAD_CONTROLLER_ACTION->$ACTION();
    }
}
?>