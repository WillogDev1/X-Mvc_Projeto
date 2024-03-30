<?php
require __DIR__ . '/vendor/autoload.php';

use App\XHandler\Http\Http;


echo Http::RETURN_METHOD();
echo "<br>";
echo Http::RETURN_URI();
echo "<br>";
$QUERRY = Http::RETURN_QUERY();
print_r($QUERRY);
echo "<br>";