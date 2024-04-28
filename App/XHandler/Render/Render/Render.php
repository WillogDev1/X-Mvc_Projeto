<?php 
namespace App\XHandler\Render\Render;

use App\XHandler\Access\Access;
use App\XHandler\Render\Controller_Render\Controller_Render;
use App\XHandler\Render\Model_Render\Model_Render;
use App\XHandler\Render\View_Render\View_Render;

class Render
{
    public static function RENDER($MODEL, $CONTROLLER, $VIEW, $ACTION, $METHOD)
    {
        try{
            $METHOD;
            if($METHOD != "GET")
            {
                Access::START_SESSION();
                self::RENDER_IF_METHOD_IS_NOT_GET($CONTROLLER, $ACTION, $MODEL);
                
            } else {
                self::RENDER_IF_METHOD_IS_GET($CONTROLLER, $ACTION, $MODEL,$VIEW);
            }
        } catch (\Exception $e){
            echo "Erro: " . $e->getMessage();
        }
    }


    public static function RENDER_IF_METHOD_IS_GET($CONTROLLER, $ACTION, $MODEL,$VIEW)
    {
        // Verificar se, usuario possui permissao com mesmo nome da ACTIOn
        // Exemplo, ACTION_ROTA = deleteUsers ACTION_USER = deleteUsers 
        // SE ACTION_USER EXIST IN ACTION_ROTA Lbiera acesso
        Controller_Render::CONTROLLER_RENDER($CONTROLLER, $ACTION);
        $DATA = Model_Render::MODEL_RENDER($MODEL, $ACTION);

        include_once View_Render::VIEW_RENDER($VIEW);
    }

    public static function RENDER_IF_METHOD_IS_NOT_GET($CONTROLLER, $ACTION, $MODEL)
    {
        Controller_Render::CONTROLLER_RENDER($CONTROLLER, $ACTION);
        // $DATA = Model_Render::MODEL_RENDER($MODEL, $ACTION);
    }
}
?>