<?php
namespace App\XHandler\Router\Router;


use App\XHandler\Http\Http;
use App\XHandler\Router\Routes\Routes;
use App\XHandler\Render\Render\Render;
use App\XHandler\Access\Access;


class Router
{
    public static function ROUTER()
    {
        $METHOD =   Http::RETURN_METHOD();
        $URI    =   Http::RETURN_URI();
        $QUERY  =   Http::RETURN_QUERY();

        $RESULT_COMPLETE_ROUTE = self::VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY);

        // Se (Uri/Url) requisitada pelo usuario não for enctrada redireciona para pagina de erro
        if ($RESULT_COMPLETE_ROUTE === NULL) {
            self::ERROR_PAGE();
            return;
        }

        $RESULT_ROUTE_CONTROLLER_ACTION =  self::RETURN_CONTROLLER_AND_ACTION($RESULT_COMPLETE_ROUTE);

        $CONTROLLER_NAME = $RESULT_ROUTE_CONTROLLER_ACTION['Controller']['Component'];

        $CONTROLLER_ACTION = $RESULT_ROUTE_CONTROLLER_ACTION['Controller']['Action'];

        // Verificar se Usuario está logado ou não.
        Access::START_SESSION();
        // Retire para ver a permissao funcionando
        //$_SESSION['SESSION_ID'] = 10;
        if(Access::VERIFY_USER_IS_LOGIN())
        {
            Render::RENDER($CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD);
        }else{
            Access::ERROR_PAGE();
        }
        

    }

    public static function VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY)
    {
        $ROUTES = Routes::routes();
        $URI_EXIST_IN_ROUTE = self::VERIFY_IF_URI_EXIST_IN_ROUTE($URI, $ROUTES);
        $METHOD_EXIST_IN_ROUTE = self::VERIFY_IF_METHOD_EXIST_IN_ROUTE($METHOD, $ROUTES, $URI);

        if ($URI_EXIST_IN_ROUTE === TRUE || $METHOD_EXIST_IN_ROUTE === TRUE) {
            return $ROUTES[$URI][$METHOD];
        } else {
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

    public static function RETURN_CONTROLLER_AND_ACTION($RESULT_COMPLETE_ROUTE) //Nome melhor encontrar // Talvez eu precise pegar isso aqui também ***Query***
    {
        $ROUTE_IN_PARTS = [];

        foreach ($RESULT_COMPLETE_ROUTE as $KEY => $VALUE) {
            list($COMPONENT, $ACTION) = explode('@', $VALUE, 2);

            $ROUTE_IN_PARTS[$KEY] = [
                'Component' => $COMPONENT,
                'Action'    => $ACTION
            ];

            return $ROUTE_IN_PARTS;
        }
    }

    public static function ERROR_PAGE()
    {
        header("Location: /page-not-found");
        exit();
    }
}
