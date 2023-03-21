<?php

namespace App\Http\Controllers;

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
    public function getOffer(Request $request)
    {
        $url = "https://dev.gosat.org/api/v1/simulacao/oferta";
        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'cpf'=> $request->cpf,
                'instituicao_id'=> $request->instituicao_id,
                'codModalidade'=> $request->codModalidade,

            ])
        ]);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        return  $body;


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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
