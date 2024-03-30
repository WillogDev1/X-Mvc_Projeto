<?php 
namespace App\XHandler\Router\Router;

use App\XHandler\Http\Http;
use App\XHandler\Router\Routes\Routes;

class Router
{
    public static function router()
    {
        $METHOD =   Http::RETURN_METHOD();
        $URI    =   Http::RETURN_URI();
        $QUERY  =   Http::RETURN_QUERY();
        
        // echo "METHOD: " . $METHOD . " URI: " . $URI . " QUERY: " . var_dump($QUERY);
        // Verificar se rota existe
        $REULT = self::VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY);
        return $REULT;
    }

    public static function VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY)
    {
        $ROUTES = Routes::routes();

        if (array_key_exists($URI, $ROUTES))
        {
            if(array_key_exists($METHOD, $ROUTES[$URI]))
            {
                return $ROUTES[$URI][$METHOD];
            }else{
                return NULL; // Metodo não permitido para o caminho
            }
        }else{
            return NULL; // Rota não Existe
        }
    }
}


?>