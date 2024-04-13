<?php 
namespace App\XHandler\Render\View_Render;

class View_Render
{
    public static function VIEW_RENDER($VIEW)
    {
        if(is_array($VIEW))
        {
            $VIEW_NAMESPACE = implode('/', $VIEW);
            $VIEW_NAME = end($VIEW);
        }else{
            $VIEW_NAMESPACE = $VIEW;
            $VIEW_NAME = $VIEW;
        }


        $LOAD_VIEW = __DIR__ . "/../../../View/$VIEW_NAMESPACE/$VIEW_NAME.php";

        if (!file_exists($LOAD_VIEW))
        {
            throw new \Exception("View: $LOAD_VIEW não encontrada: $VIEW_NAME |$VIEW");
        }

        return $LOAD_VIEW;
    }
}

?>