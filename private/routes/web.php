<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\PlongeeController;
use App\Http\Controllers\Responsable;
use App\Http\Controllers\SessionManager;
use App\Http\Controllers\User;
use App\Http\Controllers\PalanqueeController;
use App\Http\Controllers\PalanqueController;
use App\Http\Controllers\formController;


Route::get('/', function () {
    return view('connexion');
})->name('index');


// CONNEXION -----------------------------

Route::get('/Connexion', function() {
	return view('Connexion');
});

Route::match(['post'],'/gestionAuthentification',
    [ConnexionController::class, 'index']
);

Route::get('/deconnexion', 
    [DeconnexionController::class, 'deconnect']
);

Route::get('\connectionError', function() {
	return view('connectionError');
});


// SESSION --------------------------------

Route::get('/session/add', 
    [SessionManager::class, 'add']
)->name('session/add');

Route::post('/session/addSubmit', [SessionManager::class, 'addSubmit'])
->name('session/add.submit')
->middleware('role:6');;

Route::get('/session/show', 
    [SessionManager::class, 'show']
)->middleware('role: 2');

Route::get('/session/edit', 
    [SessionManager::class, 'edit']
)
->middleware('role:6');

Route::post('/session/editSubmit', [SessionManager::class, 'editSubmit'])
->name('session/edit.submit')
->middleware('role:6');

Route::get('/session/list', function() {
	return view('session/list');
})->name('session/list')->middleware('role:2');


// ROLES ----------------------------------

Route::get('/role/set',
    [Responsable::class, 'setRolls']
)->name('role/set')
->middleware('role:6');

Route::post('/role/setSubmit', [Responsable::class, 'setRollsSubmit'])
->name('role/set.submit')
->middleware('role:6');


// ACCEUIL ---------------------------------

Route::get('/home',
    [User::class, 'toHome']
)->name('home');

Route::get('/acceuil/secretaire', function () {
    return view('acceuil/secretary');
})->name('secretary.home')
->middleware('role:1');

Route::get('/acceuil/responsable', function () {
    return view('acceuil/responsable');
})->name('responsable.home')
->middleware('role:6');

Route::get('/acceuil/adherent', function () {
    return view('acceuil/member');
})->name('member.home')
->middleware('role:2');
Route::get('/profilResp', function() {
	return view('profilResp');
});

Route::get('/generationPDF', function() {
	return view('generationPDF');
});


Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);


Route::match(['get', 'post'],'/pageTest', [formController::class, 'index']);



Route::match(['get', 'post'],'/pageTest', [formController::class, 'index']);





Route::match(['get', 'post'],'/palanquees', [PalanqueController::class, 'index'])->name('palanquees.index');
Route::match(['get', 'post'],'/get-palanque-details-form', [PalanqueController::class, 'getPalanqueDetailsForm'])->name('get.palanque.details.form');
Route::match(['get', 'post'],'/store-palanque-details', [PalanqueController::class, 'storePalanqueDetails'])->name('store.palanque.details');
Route::match(['get', 'post'],'/store-adherent-details', [PalanqueController::class, 'storeAdherentDetails'])->name('store.adherent.details');


// AUTRES ---------------------------------

Route::get('/creneau', function () {
    return view('creneau');
})->middleware('role:2');
// Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);

Route::get(
    '/register/{date}/{sea_id}',
    [PlongeeController::class, 'register']
)->middleware('role:2');

Route::get('/accueil/profileDirector', function () {
    return view('accueil/profileDirector');
});

Route::get('/directorList', function () {
    return view('directorList');
});

Route::get(
    '/unregister{date}{sea_id}',
    [PlongeeController::class, 'unregister']
)->middleware('role:2');
//Route::post('/sessionSubmit', [PlongeeController::class, 'setSessionSubmit'])->name('session.submit');


// Route::post('/palanquees', 'PalanqueController@index')->name('directionPalanquees');
Route::post('/palanquees', 'PalanqueController@index')->name('directionPalanquees');
