<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;


use App\Http\Controllers\Responsable;

use app\Http\Controllers\PlongeeController;
use App\Http\Controllers\SessionManager;
use App\Http\Controllers\sessionListController;


Route::get('/', function () {
    return view('connexion');
});


// SESSION --------------------------------

Route::get('/session/add', 
    [SessionManager::class, 'add']
);
Route::post('/session/addSubmit', [SessionManager::class, 'addSubmit'])
->name('session/add.submit');

Route::get('/session/show', 
    [SessionManager::class, 'show']
);

Route::get('/session/edit', 
    [SessionManager::class, 'edit']
);
Route::post('/session/editSubmit', [SessionManager::class, 'editSubmit'])
->name('session/edit.submit');

// ROLES ----------------------------------

Route::get('/role/set',
    [Responsable::class, 'setRolls']
);
Route::post('/role/setSubmit', [Responsable::class, 'setRollsSubmit'])
->name('role/set.submit');

// AUTRES ---------------------------------

Route::get('/creneau', function () {
    return view('creneau');
});

Route::get('/sessionList', function () {
    return view('sessionList');
});

Route::get('/editSession', function () {
    return view('editSession');
});

Route::get('/sessionEdited', function () {
    return view('sessionEdited');
});


Route::get('/Plongee99', [VotreController::class, 'votreMethode']);

// Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);

Route::get('/roles',
    [Responsable::class, 'setRolls']
);
Route::post('/rolesSubmit', [Responsable::class, 'setRollsSubmit'])->name('roles.submit');

//Route::post('/sessionSubmit', [PlongeeController::class, 'setSessionSubmit'])->name('session.submit');

Route::get('/profileSecretary', function() {
	return view('profileSecretary');
})->middleware('role:1');

Route::get('/exempleDirecteur', function() {
	return view('exempleDirecteur');
});

Route::get('/deconnexion', [DeconnexionController::class, 'deconnect']);



Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);


Route::get('/Connexion', function() {
	return view('Connexion');
});

//Route::match(['get', 'post'],'/gestionAuthentification', function() {
	//return view('gestionAuthentification');
//});
Route::get('/editSession', function () {
    return view('editSession');
});
