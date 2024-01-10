<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exempleSecretaire', function() {
	return view('exempleSecretaire');
})->middleware('role:1');

Route::get('/exempleDirecteur', function() {
	return view('exempleDirecteur');
});

Route::get('/deconnexion', [DeconnexionController::class, 'deconnect']);


Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);


Route::get('/connexion', function() {
	return view('connexion');
});

//Route::match(['get', 'post'],'/gestionAuthentification', function() {
	//return view('gestionAuthentification');
//});
