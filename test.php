<?php

require_once __DIR__ . '/vendor/autoload.php';

use Suggestions\SuggestClient;
use function Suggestions\validateName;

$client = new SuggestClient(
    new GuzzleHttp\Client(), 
    '<your_token_here>'
);

if (validateName($client, 'Никулин Дмитрий Владимирович')) {
    echo "Name is valid.\n";
}
