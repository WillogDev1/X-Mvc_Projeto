<?php 
namespace App\Handlers\Http;

Class Http
{

    public static function http_Return_Method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function http_Return_Uri()
    {
        // Obtém a URI da requisição
        $uri = $_SERVER['REQUEST_URI'];

        // Remove a barra inicial, se houver
        $uriWithoutSlash = ltrim($uri, '/');

        // Obtém o caminho da URI
        $path = parse_url($uriWithoutSlash, PHP_URL_PATH);

        // Obtém os segmentos da URI
        $uriSegments = explode('/', $path);

        // Obtém o primeiro segmento da URI
        $firstSegment = isset($uriSegments[0]) ? $uriSegments[0] : '';

        // Retorna o primeiro segmento
        return $firstSegment;
    }

    public static function http_Return_Query()
    {
        // Obtém a string da query string
        $queryString = $_SERVER['QUERY_STRING'];
    
        // Inicializa um array vazio para armazenar os parâmetros
        $queryParameters = [];
    
        // Parseia a string da query string e armazena os parâmetros no array
        parse_str($queryString, $queryParameters);
    
        // Retorna o array com os parâmetros
        return $queryParameters;
    }
    

    public static function http_Return_Method_Uri_Querry()
    {
        return [
            'method'    => self::   http_Return_Method     (),
            'uri'       => self::   http_Return_Uri        (),
            'query'     => self::   http_Return_Query      ()
        ];
    }

}



?>