<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use App\Services\Services;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function store(Request $request)
    {

         $isBetween = Services::is_between($request->hire_value, $request->offer_value_max, $request->offer_value_min);


        if($isBetween != 'isValid'){
            return response()->json([
                'message' => $isBetween,
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
                'message' => 'Informações de contrato.',
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
                'message' => 'Contrato não pode ser criado por um erro interno',
            ]);
        }

        return response()->json([
            'message' => 'Contrato criado com sucesso',
            'user' => $user,
            'contract' => $contract
        ]);
    }
}
