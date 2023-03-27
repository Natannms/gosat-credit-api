<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * login.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return repsonse()->json(
                [
                    'statusCode' => 401,
                    'message' => 'Credenciais inválidas'
                ],
                401
            );
        }

        $token =  auth()->user()->createToken('secret');

        return response()->json([
            'statusCode' => 200,
            'user'=> auth()->user(),
            'token' => $token->plainTextToken,
            'message' => 'Usuario logado'
        ], 200);
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
    public function store(Request $request, User $user)
    {
        $user = new User();
        if (!$user->validate($request->all())) {
            return response()->json([
                'statusCode' => 400,
                'message' => 'Verifique os campos não preenchidos adequadamente.',
                'user' => $user->errors()
            ], 400);
        }

        $userData = $request->only('name', 'email', 'password', 'document');
        $userData['password'] =  bcrypt($userData['password']);
        if (!$user = $user->create($userData)) {
            return response()->json([
                'statusCode' => 500,
                'message' => "Erro interno. Não foi possivel crar um novo usuario",
                'user' => $user->errors()
            ], 500);
        }

        return response()->json([
            'statusCode' => 201,
            'message' => "Usuario criado com sucesso",
            'user' => $user
        ], 201);
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
