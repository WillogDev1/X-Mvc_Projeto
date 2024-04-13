<?php 
namespace App\XHandler\Render\Model_Render;


class Model_Render
{
    public static function MODEL_RENDER($MODEL, $ACTION)
    {

        $PATH_TO_MODEL = self::MODEL_PATH($MODEL);

        if(!class_exists($PATH_TO_MODEL))
        {
            throw new \Exception("Model $MODEL não existe");
        }

        $LOAD_MODEL_ACTION = new $PATH_TO_MODEL;

        if(method_exists($LOAD_MODEL_ACTION, $ACTION))
        {
            $DATA = $LOAD_MODEL_ACTION->$ACTION();

            return $DATA;
        }else{
            throw new \Exception("Método $ACTION não encontrado na classe $MODEL");
        }



    }


    public static function MODEL_PATH($PATH_MODEL)
    {
        if(is_array($PATH_MODEL))
        {
            $MODEL_NAMESPACE = implode('\\', $PATH_MODEL);
            $MODEL_NAME = end($PATH_MODEL);
        }else{
            $MODEL_NAMESPACE = $PATH_MODEL;
            $MODEL_NAME = $PATH_MODEL;
        }

        return "\\App\\Model\\$MODEL_NAMESPACE\\$MODEL_NAME";
    }
}

?>