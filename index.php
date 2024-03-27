<?php 
require __DIR__ . '/vendor/autoload.php';

use App\Handlers\Http\Http;
use App\Handlers\Router\Router;

$http_Method_Uri_Querry = Http::http_Return_Method_Uri_Querry();

$http_Method = $http_Method_Uri_Querry['method'];

$http_Uri = $http_Method_Uri_Querry['uri'];

$http_Querry = $http_Method_Uri_Querry['query'];


Router::router($http_Uri);

?>