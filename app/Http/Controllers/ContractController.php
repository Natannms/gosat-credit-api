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
    public function store(Request $request)
    {
        //
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
