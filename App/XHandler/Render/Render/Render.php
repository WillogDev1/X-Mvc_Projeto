<?php 
namespace App\XHandler\Render\Render;

use App\XHandler\Render\Controller_Render\Controller_Render;
use App\XHandler\Render\Model_Render\Model_Render;
use App\XHandler\Render\View_Render\View_Render;

class Render
{
    public static function RENDER($MODEL, $CONTROLLER, $VIEW, $ACTION, $METHOD) // Dividir a renderização de paginas GET para outras
    {
        try{
            $METHOD;
            if($METHOD != "GET")
            {
                Controller_Render::CONTROLLER_RENDER($CONTROLLER, $ACTION);
                $DATA = Model_Render::MODEL_RENDER($MODEL, $ACTION);
            } else {
                Controller_Render::CONTROLLER_RENDER($CONTROLLER, $ACTION);
                $DATA = Model_Render::MODEL_RENDER($MODEL, $ACTION);

                include_once View_Render::VIEW_RENDER($VIEW);
            }
        } catch (\Exception $e){
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>