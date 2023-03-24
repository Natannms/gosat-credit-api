<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
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
    public function store(Request $request, Role $role)
    {

        if(!$role->validate($request->all())){
            return response()->json([
                'message' => 'Dados não validados para criação de perfil de usuario',
                'errors' => $role->errors()
            ], 500);
        }

        $role->user_id = $request->user_id;
        $role->role = $request->role;
        $role->save();

        if(!$role){
            return response()->json([
                'message' => 'Erro ao criar o perfil do usuário'
            ], 500);
        }

        return response()->json([
            'message' => 'Perfil do usuário criado com sucesso'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role, $id)
    {
        $role = Role::find($id);
        if($role){
            return response()->json($role);
        }else{
            return response()->json([
                'message' => 'Perfil do usuário não encontrado'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
