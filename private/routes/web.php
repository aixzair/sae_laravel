<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\PlongeeController;
use App\Http\Controllers\Responsable;
use App\Http\Controllers\SessionManager;
use App\Http\Controllers\User;


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

Route::get('/plongée/add', 
    [SessionManager::class, 'add']
)->name('session/add');

Route::post('/plongée/addSubmit', [SessionManager::class, 'addSubmit'])
->name('session/add.submit');
//->middleware('role:6');

Route::get('/session/show', 
    [SessionManager::class, 'show']
)->name('session/show');
//->middleware('role: 2');

Route::get('/plongée/edit', 
    [SessionManager::class, 'edit']
)
->middleware('role:6');

Route::post('/plongée/editSubmit', [SessionManager::class, 'editSubmit'])
->name('session/edit.submit')
->middleware('role:6');

Route::get('/plongée/list', function() {
	return view('session/list');
})->name('session/list');
//->middleware('role:2');

Route::get('/plongée/director', function() {
	return view('session/director');
})->name('session/director');

Route::get('/plongée/listeMembres',
    [SessionManager::class, 'membersList'] 
)->name('session/membersList');


// ROLES ----------------------------------

Route::get('/role/set',
    [Responsable::class, 'setRolls']
)->name('role/set');
//->middleware('role:6');

Route::post('/role/setSubmit', [Responsable::class, 'setRollsSubmit'])
->name('role/set.submit');
//->middleware('role:6');


// ACCEUIL ---------------------------------

Route::get('/home',
    [User::class, 'toHome']
)->name('home');

Route::get('/acceuil/secretaire', function () {
    return view('acceuil/secretary');
})->name('secretary.home');
//->middleware('role:1');

Route::get('/acceuil/responsable', function () {
    return view('acceuil/responsable');
})->name('responsable.home');
//->middleware('role:6');

Route::get('/acceuil/directeur', function () {
    return view('acceuil/director');
})->name('director.home');

Route::get('/acceuil/adherent', function () {
    return view('acceuil/member');
})->name('member.home');
//->middleware('role:2');

Route::get('/acceuil/voirPlus', function () {
    return view('acceuil/showMore');
})->name('showMore.home');

// AUTRES ---------------------------------

Route::get('/plongée/register/{date}/{sea_id}', [PlongeeController::class, 'register']);
Route::get('/plongée/unregister/{date}/{sea_id}', [PlongeeController::class, 'unregister']);

Route::get('/editSession', function () {
    return view('editSession');
});
Route::get('/creneau', function () {
    return view('creneau');
});


Route::get('/header', function() {
	return view('header');
});

Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);

Route::get(
    '/plongée/unregister{date}{sea_id}',
    [PlongeeController::class, 'unregister']
);
//->middleware('role:2');