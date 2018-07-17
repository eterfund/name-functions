<?php

require_once __DIR__ . '/vendor/autoload.php';

use Names\SuggestClient;
use function Names\validateName;

$client = new SuggestClient(
    new GuzzleHttp\Client(), 
    '<your_token_here>'
);

if (validateName($client, 'Никулин Дмитрий Владимирович')) {
    echo "Name is valid.\n";
}
