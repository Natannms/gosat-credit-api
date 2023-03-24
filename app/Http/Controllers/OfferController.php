<?php

namespace App\Http\Controllers;

use App\Services\Services;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function getOfferValues($instituicao_id, $codModalidade, $cpf)
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

            return  json_decode($body);
        } catch (\Throwable $th) {

             $errorMessage = Services::extractErrorMessage($th->getMessage());

            if ($th->getResponse()->getStatusCode() === 422) {
                return response()->json(['error' => json_decode('"' . $errorMessage . '"')], 422);
            }

            return response()->json(['error' => 'Erro na requisição'], 500);
        }
    }

    public function offer(Request $request, $cpf)
    {
        $offers = $request->offers;
        $list = [];
        foreach ($offers as $key => $item) {
            $valuesOffer = $this->getOfferValues($item['instituicao_id'], $item['codModalidade'], $cpf);
            $list[] =  [
                "instituicao_id" => $item['instituicao_id'],
                "codModalidade" => $item['codModalidade'],
                "offer" => [
                    "QntParcelaMax" =>  $valuesOffer->QntParcelaMax,
                    "QntParcelaMin" =>  $valuesOffer->QntParcelaMin,
                    "valorMin" => $valuesOffer->valorMin,
                    "valorMax" => $valuesOffer->valorMax,
                    "jurosMes" =>  $valuesOffer->jurosMes,
                ],
            ];

        }

        $result = $request->filterKey ? match($request->filterKey){
            'juros' => Services::loweInterest($list),
            'maior-valor'=> Services::highestRedeemedValue($list),
            'menor-valor'=> Services::lowestRedeemedValue($list),
            'maior-parcela'=> Services::greaterNumberOfInstallments($list),
            'menor-parcela'=> Services::smallerAmountOfInstallments($list),
        } :
        $list;

       return $result;
    }

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
