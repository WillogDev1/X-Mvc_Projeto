<?php 
namespace App\XHandler\Render\View_Render;

class View_Render
{
    public static function VIEW_RENDER($VIEW)
    {
        $LOAD_VIEW = __DIR__ . "/../../../View/$VIEW/$VIEW.php";

        if (!file_exists($LOAD_VIEW))
        {
            throw new \Exception("View $VIEW não encontrada");
        }

        return $LOAD_VIEW;
    }
}

?>