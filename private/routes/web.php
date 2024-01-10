<?php

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

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\sessionListController;


Route::get('/', function () {
    return view('connexion');
});

Route::get('/creneau', function () {
    return view('creneau');
});

Route::get('/addSession', function () {
    return view('addSession');
});

Route::get('/sessionList', function () {
    return view('sessionList');
});

Route::get('/sessionAdded', function () {
    return view('sessionAdded');
});

Route::get('/editSession', function () {
    return view('editSession');
});

Route::get('/sessionEdited', function () {
    return view('sessionEdited');
});
// Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);

Route::get('/roles',
    [Responsable::class, 'setRolls']
);
Route::post('/rolesSubmit', [Responsable::class, 'setRollsSubmit'])->name('roles.submit');

Route::get('/profileSecretary', function() {
	return view('profileSecretary');
})->middleware('role:1');

Route::get('/exempleDirecteur', function() {
	return view('exempleDirecteur');
});

Route::get('/profileMember', function() {
	return view('profileMember');
});

Route::get('/header', function() {
	return view('header');
});

Route::get('\connectionError', function() {
	return view('connectionError');
});

Route::get('/profilResp', function() {
	return view('profilResp');
});

Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);


//Route::match(['get', 'post'],'/gestionAuthentification', function() {
	//return view('gestionAuthentification');
//});
