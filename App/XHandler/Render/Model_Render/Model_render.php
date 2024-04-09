<?php 
namespace App\XHandler\Render\Model_Render;


class Model_Render
{
    public static function MODEL_RENDER($MODEL, $ACTION)
    {
        $TRY_LOAD_MODEL_AND_ACTION = "\\App\\Model\\$MODEL\\$MODEL";

        if(!class_exists($TRY_LOAD_MODEL_AND_ACTION))
        {
            throw new \Exception("Model $MODEL não existe");
        }

        $LOAD_MODEL_ACTION = new $TRY_LOAD_MODEL_AND_ACTION;

        if(method_exists($LOAD_MODEL_ACTION, $ACTION))
        {
            $DATA = $LOAD_MODEL_ACTION->$ACTION();

            return $DATA;
        }else{
            throw new \Exception("Método $ACTION não encontrado na classe $MODEL");
        }



    }
}

?>