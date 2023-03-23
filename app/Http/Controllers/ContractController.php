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
    public function create($user_id, Contract $contract)
    {
         $contract->save();
         if(!$contract){
            return false;
        }

        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(contract $contract)
    {
        //
    }
}
