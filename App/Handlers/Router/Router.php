<?php 
namespace App\Handlers\Router;

use App\Handlers\Routes\Routes;
use App\Handlers\RenderController\Render_Controller;




Class Router
{
    public static function router($http_Uri)
    {
        $ALL_ROUTES = Routes::routes();
        // Remove a barra inicial da URI
        $http_Uri_Slashe = "/" . $http_Uri;

        if(isset($ALL_ROUTES[$http_Uri_Slashe]))
        {
            //echo "Path Existe";
            // TODO: Pegar o valor Login@Home e dividilo pelo @ para passar no lugar de index
          $content =  Render_Controller::render_Controller(ucfirst($http_Uri), 'index');
          echo $content;
        }else{
            echo "Path Não Existe";
        }
    }
    
}



?>