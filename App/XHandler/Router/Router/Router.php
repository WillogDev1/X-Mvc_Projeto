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
        
        $RESULT = self::VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY);

        // Se (Uri/Url) requisitada pelo usuario não for enctrada redireciona para pagina de erro
        if ($RESULT === NULL) {
            self::ERROR_PAGE();
            return;
        }

        // Quebrar em 3 partes, Controller, Action, Query
        
        return $RESULT;
    }

    public static function VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY)
    {
        $ROUTES = Routes::routes();
        $URI_EXIST_IN_ROUTE = self::VERIFY_IF_URI_EXIST_IN_ROUTE($URI, $ROUTES);
        $METHOD_EXIST_IN_ROUTE = self::VERIFY_IF_METHOD_EXIST_IN_ROUTE($METHOD, $ROUTES, $URI);

        if ($URI_EXIST_IN_ROUTE === TRUE || $METHOD_EXIST_IN_ROUTE === TRUE)
        {
            return $ROUTES[$URI][$METHOD];
        }else{
            return NULL;
        }


    }

    
    public static function VERIFY_IF_URI_EXIST_IN_ROUTE($URI, $ROUTES)
    {
        return array_key_exists($URI, $ROUTES);
    }

    public static function VERIFY_IF_METHOD_EXIST_IN_ROUTE($METHOD, $ROUTES, $URI)
    {
        return isset($ROUTES[$URI]) && array_key_exists($METHOD, $ROUTES[$URI]);
    }
    public static function ERROR_PAGE()
    {
        header("Location: /page-not-found");
        exit();
    }
}


?>