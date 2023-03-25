<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\RoleController;
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
Route::post('/offers', [OfferController::class, 'offer']);

Route::post('/contract', [LoanController::class, 'store']);
Route::get('/contract/{id}', [ContractController::class, 'show']);

Route::post('/role', [RoleController::class, 'store']);
Route::get('/role/{id}', [RoleController::class, 'show']);

//Authentication
Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
