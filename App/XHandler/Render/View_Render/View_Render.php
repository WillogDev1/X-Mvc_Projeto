<?php 
namespace App\XHandler\Render\View_Render;

class View_Render
{
    public static function VIEW_RENDER($VIEW)
    {

        $PATH_TO_MODEL = self::VIEW_PATH($VIEW);


        if (!file_exists($PATH_TO_MODEL))
        {
            throw new \Exception("View: $PATH_TO_MODEL não encontrada: $VIEW_NAME |$VIEW");
        }

        return $PATH_TO_MODEL;
    }

    public static function VIEW_PATH($PATH_VIEW)
    {
        if(is_array($PATH_VIEW))
        {
            $VIEW_NAMESPACE = implode('/', $PATH_VIEW);
            $VIEW_NAME = end($PATH_VIEW);
        }else{
            $VIEW_NAMESPACE = $PATH_VIEW;
            $VIEW_NAME = $PATH_VIEW;
        }

        return __DIR__ . "/../../../View/$VIEW_NAMESPACE/$VIEW_NAME.php";
    }


}

?>