<?php
require __DIR__ . '/vendor/autoload.php';

use App\XHandler\Http\Http;
use App\XHandler\Router\Router\Router;

$RETURN = Router::ROUTER();

include_once $RETURN;