<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OpportunitiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Credit Routes
Route::get('/opportunities/{cpf}', [OpportunitiesController::class, 'getOpportunities']);
Route::get('/offer/{cpf}/{instituicao_id}/{codModalidade}', [OfferController::class, 'show']);
Route::post('/contract', [LoanController::class, 'store']);
Route::get('/contract/{id}', [ContractController::class, 'show']);

//Authentication
Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
