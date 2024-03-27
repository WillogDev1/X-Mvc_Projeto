<?php
namespace App\Handlers\RenderController;


class Render_Controller
{
    public static function render_Controller($controller, $method)
    {
        $controllerClass = "App\\Controller\\$controller\\$controller";
        //echo $controllerClass;
        // Verifica se a classe do controlador existe
        if(class_exists($controllerClass)) {
            // Cria uma nova instância do controlador
            $instance = new $controllerClass();

            // Verifica se o método existe na classe do controlador
            if(method_exists($instance, $method)) {
                // Chama o método
                //echo "Encontrou o metodo";
                return $instance->$method($controller);
                
            } else {
                echo "Método não encontrado.";
            }
        } else {
            echo "Controlador não encontrado.";
        }
    }
}
?>