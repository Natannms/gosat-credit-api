<?php

namespace App\Http\Controllers;

use App\Services\Services;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function show($cpf, $instituicao_id, $codModalidade)
    {
        try {
            $url = "https://dev.gosat.org/api/v1/simulacao/oferta";
            $client = new Client();
            $response = $client->post($url, [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode([
                    'cpf' => $cpf,
                    'instituicao_id' => $instituicao_id,
                    'codModalidade' => $codModalidade,

                ])
            ]);

            $body = $response->getBody();

            return  $body;
        } catch (\Throwable $th) {

             $errorMessage = Services::extractErrorMessage($th->getMessage());

            if ($th->getResponse()->getStatusCode() === 422) {
                return response()->json(['error' => json_decode('"' . $errorMessage . '"')], 422);
            }

            return response()->json(['error' => 'Erro na requisição'], 500);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
