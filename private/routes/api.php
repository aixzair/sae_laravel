<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\APIController;

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
Route::get('exemple', function (Request $request) {
	Log::debug("API active");
	return Response()->json(['test' => 'ceci est un test']);
});



Route::get('/adherents/{seaId}/{plonDate}/{palId}', [APIController::class, 'getAdherentsPalanquee']);
Route::get('/adherents/{seaId}/{plonDate}', [APIController::class, 'getAdherentsInscription']);

