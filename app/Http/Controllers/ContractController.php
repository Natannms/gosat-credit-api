<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;

class ContractController extends Controller
{
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
    public function store(Request $request, Contract $contract)
    {
        if(!$contract->validate($request->all())){
            return response()->json([
                'statusCode'=> 400,
                'message' => 'Contrato não pode ser criado',
                'errors' => $contract-> errors()
            ],400);
        }

        $contract->instituicao = $request->instituicao;
        $contract->instituicao_id = $request->instituicao_id;
        $contract->codModalidade = $request->codModalidade;
        $contract->user_id = $request->user_id;
        $contract->offer_qnt_installments_max = $request->offer_qnt_installments_max;
        $contract->offer_qnt_installments_min = $request->offer_qnt_installments_min;
        $contract->offer_juros_mes = $request->offer_juros_mes;
        $contract->offer_value_max = $request->offer_value_max;
        $contract->offer_value_min = $request->offer_value_min;
        $contract->hire_value = $request->hire_value;
        $contract->hire_qnt_installments = $request->hire_qnt_installments;
        $contract->save();

        if(!$contract){
            return response()->json([
                'statusCode'=> 500,
                'message' => 'Contrato não pode ser criado',
            ], 500);
        }

        return response()->json([
            'statusCode'=> 200,
            'message' => 'Contrato criado com sucesso',
            'data' => $contract
        ], 200);

    }
    /**
     * Create a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($user_id, Contract $Contract)
    {
         $Contract->save();
         if(!$Contract){
            return false;
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $Contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $Contract, $id)
    {
        $contract =  Contract::find($id);
        if($contract){
            return response()->json($contract);
        }else{
            return response()->json([
                'message' => 'Contrato não encontrado'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $Contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $Contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $Contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $Contract)
    {
        //
    }
}
