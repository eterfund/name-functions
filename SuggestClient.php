<?php

namespace Names;

class SuggestClient {
    private $client;
    private $token;

    public function __construct ($client, string $token) {
        $this->client = $client;
        $this->token = $token;
    }

    public function suggestName (string $fullname) {
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => "Token {$this->token}",
            'Content-Type' => 'application/json'
        ];
        $data = [
            'query' => $fullname
        ];
        $response = $this->client->post(
            'https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/fio',
            [
                'headers' => $headers,
                'json' => $data
            ]
        );
        $data = json_decode($response->getBody());
        if (!$data) {
            return null;
        }

        return $this->transformData($data->suggestions);
    }

    private function transformData ($suggestions) {
        return array_map(function ($suggestion) {
            return $suggestion->data;
        }, $suggestions);
    }
}
