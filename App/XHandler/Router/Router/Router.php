<?php

namespace App\XHandler\Router\Router;


use App\XHandler\Http\Http;
use App\XHandler\Router\Routes\Routes;
use App\XHandler\Render\Render\Render;
use App\XHandler\Access\Access;


class Router
{
    private ?array  $GET_ROUTE = null;
    private array   $GET_CONTROLLER_AND_ACTION;
    private array   $CONTROLLER_NAME;
    private string  $CONTROLLER_ACTION;
    private string  $METHOD;
    private string  $URI;
    private array   $QUERY;
    private array   $PROTECTED_ROUTES;
    private array   $FREE_ROUTES;
    private array   $PROTECTED_FREE_ROUTES;

    public function __construct()
    {
        $HTTP   = new Http();
        $ROUTES = new Routes();


        $this->METHOD =         $HTTP->getRequestMethod();
        $this->URI    =         $HTTP->getRequestUri();
        $this->QUERY  =         $HTTP->getQueryString();

        $this->PROTECTED_ROUTES             =       $ROUTES->getProtectedRoutes();
        $this->PROTECTED_FREE_ROUTES        =       $ROUTES->getProtectedFreeRoutes();
        $this->FREE_ROUTES                  =       $ROUTES->getFreeRoutes();

        $this->GET_ROUTE = self::VERIFY_IF_ROUTE_EXIST();

        if ($this->GET_ROUTE === NULL) {
            self::ERROR_PAGE();
            return;
        }
        
        $this->GET_CONTROLLER_AND_ACTION = self::RETURN_CONTROLLER_AND_ACTION($this->GET_ROUTE);

        if (is_array($this->GET_CONTROLLER_AND_ACTION['Controller']['Component'])) {

            $this->CONTROLLER_NAME = $this->GET_CONTROLLER_AND_ACTION['Controller']['Component'];
        } else {

            $this->CONTROLLER_NAME = [$this->GET_CONTROLLER_AND_ACTION['Controller']['Component']];
        }

        $this->CONTROLLER_ACTION = $this->GET_CONTROLLER_AND_ACTION['Controller']['Action'];


        self::VERIFY_IF_ROUTE_NEEDS_LOGGIN();
    }


    public static function ROUTER()
    {

        //$METHOD =   Http::RETURN_METHOD();
        //$URI    =   Http::RETURN_URI();
        //$QUERY  =   Http::RETURN_QUERY();
        /*
        $HTTP = new Http();

        $METHOD =       $HTTP->getRequestMethod ();
        $URI    =       $HTTP->getRequestUri    ();
        $QUERY  =       $HTTP->getQueryString   ();

        $RESULT_COMPLETE_ROUTE = self::VERIFY_IF_ROUTE_EXIST($URI, $METHOD, $QUERY);

        // Se (Uri/Url) requisitada pelo usuario não for enctrada redireciona para pagina de erro
        if ($RESULT_COMPLETE_ROUTE === NULL) {
            self::ERROR_PAGE();
            return;
        }
        
        
        $RESULT_ROUTE_CONTROLLER_ACTION =  self::RETURN_CONTROLLER_AND_ACTION($RESULT_COMPLETE_ROUTE);

        $CONTROLLER_NAME = $RESULT_ROUTE_CONTROLLER_ACTION['Controller']['Component'];

        $CONTROLLER_ACTION = $RESULT_ROUTE_CONTROLLER_ACTION['Controller']['Action'];

       return self::VERIFY_IF_ROUTE_NEEDS_LOGGIN($URI, $CONTROLLER_NAME, $CONTROLLER_ACTION, $METHOD);
       */
    }



    private function VERIFY_IF_ROUTE_EXIST(): ?array
    {
        //$ROUTES = Routes::ROUTES();

        $URI_EXIST_IN_ROUTE = self::VERIFY_IF_URI_EXIST_IN_ROUTE($this->PROTECTED_ROUTES);
        $METHOD_EXIST_IN_ROUTE = self::VERIFY_IF_METHOD_EXIST_IN_ROUTE($this->PROTECTED_ROUTES);

        if ($URI_EXIST_IN_ROUTE === TRUE || $METHOD_EXIST_IN_ROUTE === TRUE) {
            return $this->PROTECTED_ROUTES[$this->URI][$this->METHOD];
        } else {
            return NULL;
        }
    }


    private function VERIFY_IF_URI_EXIST_IN_ROUTE($ROUTES): bool
    {
        return array_key_exists($this->URI, $ROUTES);
    }

    private function VERIFY_IF_METHOD_EXIST_IN_ROUTE($ROUTES): bool
    {
        return isset($ROUTES[$this->URI]) && array_key_exists($this->METHOD, $ROUTES[$this->URI]);
    }

    private function RETURN_CONTROLLER_AND_ACTION(): array
    {
        $ROUTE_IN_PARTS = [];

        foreach ($this->GET_ROUTE as $KEY => $VALUE) {
            // Primeiro, dividimos pelo último '@' para garantir que a ação
            // seja extraída corretamente, mesmo que ela contenha '@'
            $lastAtIndex = strrpos($VALUE, '@');
            $COMPONENT = substr($VALUE, 0, $lastAtIndex);
            $ACTION = substr($VALUE, $lastAtIndex + 1);

            // Se houver uma barra '/', consideramos o componente como uma única unidade
            if (strpos($COMPONENT, '/') !== false) {
                $COMPONENT = explode('/', $COMPONENT);
            }

            $ROUTE_IN_PARTS[$KEY] = [
                'Component' => $COMPONENT,
                'Action'    => $ACTION
            ];
        }

        return $ROUTE_IN_PARTS;
    }


    private function VERIFY_IF_ROUTE_NEEDS_LOGGIN(): void
    {
        $RENDER = new Render();

        $RENDER->setController($this->CONTROLLER_NAME);
        $RENDER->setModel($this->CONTROLLER_NAME);
        $RENDER->setAction($this->CONTROLLER_ACTION);
        $RENDER->setView($this->CONTROLLER_NAME);
        $RENDER->setMethod($this->METHOD);
        $RENDER->setQuery($this->QUERY);

        if (array_key_exists($this->URI, $this->FREE_ROUTES)) {
            //Render::RENDER($this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_ACTION, $this->METHOD); 
            $RENDER->RENDER();
        } else {
            //$_SESSION['SESSION_ID'] = 1; //Para testes
            if (Access::ACCESS()) {
                if (array_key_exists($this->URI, $this->PROTECTED_FREE_ROUTES)) {
                    //Render::RENDER($this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_ACTION, $this->METHOD);
                    $RENDER->RENDER();
                } else {
                    if (in_array($this->CONTROLLER_ACTION, $_SESSION['user_permissions'])) {
                        //Render::RENDER($this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_ACTION, $this->METHOD);
                        $RENDER->RENDER();
                    } else {
                        //var_dump( $_SESSION['user_permissions']);
                        echo json_encode(["message" => "Sem permissão"]);
                    }
                }
            } else {
                header("Location: /login");
                exit();
            }
        }
    }









    /*
    private function VERIFY_IF_ROUTE_NEEDS_LOGGIN()
    {
        $ROUTES = new Routes();

        $this->PROTECTED_ROUTES =       $ROUTES->getProtectedRoutes ();
        $this->FREE_ROUTES      =       $ROUTES->getFreeRoutes      ();

        $ROUTES_NOT_LOGGIN = Routes::ROUTES_THAT_DONT_NEED_LOGGIN();
        
        if(array_key_exists($this->URI, $this->FREE_ROUTES))
        {
            Render::RENDER($this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_ACTION, $this->METHOD);
        }else{
            //$_SESSION['SESSION_ID'] = 1; //Para testes
            if(Access::ACCESS())
            {
                if(in_array($this->CONTROLLER_ACTION, $_SESSION['user_permissions'])){
                    Render::RENDER($this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_NAME, $this->CONTROLLER_ACTION, $this->METHOD);
                }else{
                    echo "Sem Permissão";
                }
            }else{
                header("Location: /login");
                exit();
            }
        }                
        
    }
*/
    public static function ERROR_PAGE()
    {
        header("Location: /page-not-found");
        exit();
    }
}
