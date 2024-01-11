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
use App\Http\Controllers\PalanqueeController;
use App\Http\Controllers\PalanqueController;


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

/*Route::get('/palanquees', function() {
	return view('palanquees');
});*/

Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);

//Route::match(['get', 'post'],'/generate-palanquees', [PalanqueeController::class, 'generatePalanquees'])->name('generate-palanquees');

//Route::match(['get', 'post'],'/save-palanquees', [PalanqueeController::class, 'savePalanquees'])->name('save-palanquees');

// routes/web.php



/*Route::match(['get', 'post']'/palanquees', [PalanqueController::class, 'index'])->name('palanque.index');
Route::match(['get', 'post']'/palanque', [PalanqueController::class, 'store'])->name('palanque.store');
Route::post('/store-palanque-details', [PalanqueController::class, 'storePalanqueDetails'])->name('store.palanque.details');*/


Route::match(['get', 'post'],'/palanquees', [PalanqueController::class, 'index'])->name('palanquees.index');
Route::match(['get', 'post'],'/get-palanque-details-form', [PalanqueController::class, 'getPalanqueDetailsForm'])->name('get.palanque.details.form');
Route::match(['get', 'post'],'/store-palanque-details', [PalanqueController::class, 'storePalanqueDetails'])->name('store.palanque.details');
Route::match(['get', 'post'],'/store-adherent-details', [PalanqueController::class, 'storeAdherentDetails'])->name('store.adherent.details');


//Route::match(['get', 'post'],'/gestionAuthentification', function() {
	//return view('gestionAuthentification');
//});
