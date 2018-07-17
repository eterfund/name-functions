<?php

namespace Suggestions;

require_once __DIR__ . '/vendor/autoload.php';

use Suggestions\SuggestClient;

const DEFAULT_FORMAT = 'SNP';

/**
 * format:
 * S = surname, N = name, P = patronymic
 */
function joinName ($parts, string $format = DEFAULT_FORMAT) {
    if (is_array($parts)) {
        $parts = (object)$parts;
    }

    $formatFields = [
        'S' => 'surname',
        'N' => 'name',
        'P' => 'patronymic'
    ];

    return implode(' ', array_map(function ($formatLetter) use ($parts, $formatFields) {
        $field = $formatFields[$formatLetter];
        return $parts->$field;
    }, str_split($format)));
}

function splitName (SuggestClient $client, string $name) {
    $suggestions = $client->suggestName($name);
    return $suggestions[0];
}

function validateName (SuggestClient $client, string $name, string $format = DEFAULT_FORMAT) {
    return joinName(splitName($client, $name), $format) === $name;
}
