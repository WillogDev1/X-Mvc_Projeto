<?php 
namespace  App\XHandler\Http;

class Http
{
    private string  $REQUEST_METHOD;
    private string  $REQUEST_URI;
    private array   $QUERY_STRING;

    public function __construct()
    {
        $this->REQUEST_METHOD   =       self::RETURN_METHOD ();
        $this->REQUEST_URI      =       self::RETURN_URI    ();
        $this->QUERY_STRING     =       self::RETURN_QUERY  ();
    }

    private function RETURN_METHOD(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function RETURN_URI(): string
    {
        $RETURNED_URI = $_SERVER['REQUEST_URI'];

        $PARSE_URI = parse_url($RETURNED_URI);

        return $PARSE_URI['path'] ?? '';
    }

    private function RETURN_QUERY(): array
    {
        if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {

            $QUERY_STRING = $_SERVER['QUERY_STRING'];
            $PARAMS = [];

            parse_str($QUERY_STRING, $PARAMS);

            unset($PARAMS['url']);

            return $PARAMS;
        }
        return [];
    }

    // Getters
    public function getRequestMethod(): string
    {
        return $this->REQUEST_METHOD;
    }

    public function getRequestUri(): string
    {
        return $this->REQUEST_URI;
    }

    public function getQueryString(): array
    {
        return $this->QUERY_STRING;
    }
}