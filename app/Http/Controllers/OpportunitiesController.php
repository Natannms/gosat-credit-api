<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OpportunitiesController extends Controller
{

    public function is_between($hire_value_max, $offer_value_max, $coffer_value_min)
    {
        return ($hire_value_max <= $offer_value_max && $hire_value_max >= $coffer_value_min);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hireLoan(Request $request)
    {
        if (!$this->is_between($request->hire_value, $request->offer_value_max, $request->offer_value_min)) {
            return response()->json([
                'message' => 'O valor '.$request->hire_value.' solicitado não está entre '.$request->offer_value_min.' e '.$request->offer_value_max,
            ]);
        }

        //create a user
        $user = new User();
        if (!$user->validate($request->all())) {
            return response()->json([
                'message' => 'User data is not valid',
                'user' => $user->errors()
            ]);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->document = $request->document;
        $user->save();

        // //create a contract

        $contract = new Contract();
        //validate a contract fields

        if (!$contract->validate($request->all())) {
            return response()->json([
                'message' => 'Contract data is not valid',
                'contract' => $contract->errors()
            ]);
        }

        $contract->instituicao = $request->instituicao;
        $contract->instituicao_id = $request->instituicao_id;
        $contract->codModalidade = $request->codModalidade;
        $contract->user_id = $user->id;
        $contract->offer_qnt_installments_max = $request->offer_qnt_installments_max;
        $contract->offer_qnt_installments_min = $request->offer_qnt_installments_min;
        $contract->offer_juros_mes = $request->offer_juros_mes;
        $contract->offer_value_max = $request->offer_value_max;
        $contract->offer_value_min = $request->offer_value_min;
        $contract->hire_value = $request->hire_value;
        $contract->hire_qnt_installments = $request->hire_qnt_installments;


        //store a contract
        $contractController =  new ContractController();
        $storeContract = $contractController->create($user->id, $contract);


        if (!$storeContract) {
            $user->delete();
            return response()->json([
                'message' => 'Contract not created',
            ]);
        }

        return response()->json([
            'message' => 'Contract created',
            'user' => $user,
            'contract' => $contract
        ]);
    }
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
                'cpf' => $cpf
            ])
        ]);

        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        return  $body;
    }

    public function getOneOffer($cpf, $instituicao_id, $codModalidade)
    {
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

        $statusCode = $response->getStatusCode();
        $body = $response->getBody();

        return  $body;
    }
    public function getOffer($cpf, $instituicao_id, $codModalidade)
    {
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
