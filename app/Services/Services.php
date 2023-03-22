<?php

namespace App\Http\Services;

class Services
{
    public string $url;

    // constructor
    public function __construct()
    {
        $this->url = "https://dev.gosat.org/api/v1/simulacao/";
    }

    static public function getOpportunities($cpf){
        $url = "https://dev.gosat.org/api/v1/simulacao/credito";
        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'cpf'=> $cpf
            ])
        ]);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        return  $body;
    }
}
