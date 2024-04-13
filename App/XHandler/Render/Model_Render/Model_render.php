<?php 
namespace App\XHandler\Render\Model_Render;


class Model_Render
{
    public static function MODEL_RENDER($MODEL, $ACTION)
    {
        if(is_array($MODEL))
        {
            $MODEL_NAMESPACE = implode('\\', $MODEL);
            $MODEL_NAME = end($MODEL);
        }else{
            $MODEL_NAMESPACE = $MODEL;
            $MODEL_NAME = $MODEL;
        }

        $TRY_LOAD_MODEL_AND_ACTION = "\\App\\Model\\$MODEL_NAMESPACE\\$MODEL_NAME";

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