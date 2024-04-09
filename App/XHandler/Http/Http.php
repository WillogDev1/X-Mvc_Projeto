<?php 
namespace  App\XHandler\Http;

class Http
{
    public static function RETURN_METHOD()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    public static function RETURN_URI()
    {
        $RETURNED_URI = $_SERVER['REQUEST_URI'];

        $PARSE_URI = parse_url($RETURNED_URI);

        $PATH = $PARSE_URI['path'];

        return $PATH;
    }
    public static function RETURN_QUERY()
    {
        if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
        {
            $QUERRY_STRING = $_SERVER['QUERY_STRING'];
            $PARAMS = [];
            parse_str($QUERRY_STRING, $PARAMS);

            unset($PARAMS['url']);

            return $PARAMS;
        }
        return [];
    }
}


?>