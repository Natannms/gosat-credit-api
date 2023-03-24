<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OpportunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getOpportunities($cpf)
    {
        try {
            $url = "https://dev.gosat.org/api/v1/simulacao/credito";
            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    'cpf' => $cpf
                ])
            ]);
            return json_decode($response->getBody())->instituicoes;
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'CPF não encontrado',
                'error' => $th->getMessage()
            ]);
        }
    }
}
