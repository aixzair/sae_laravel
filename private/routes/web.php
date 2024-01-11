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
)->name('role.set');
Route::post('/role/setSubmit', [Responsable::class, 'setRollsSubmit'])
->name('role/set.submit');


// ACCEUIL ---------------------------------

Route::get('/acceuil/responsable', function () {
    return view('acceuil/responsable');
})->name('responsable.home');

Route::get('/acceuil/adherent', function () {
    return view('acceuil/member');
})->name('member.home');


// AUTRES ---------------------------------

Route::get('/creneau', function () {
    return view('creneau');
});
// Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);

Route::get('/register/{date}/{sea_id}', [PlongeeController::class, 'register']);
Route::get('/unregister{date}{sea_id}', [PlongeeController::class, 'unregister']);
//Route::post('/sessionSubmit', [PlongeeController::class, 'setSessionSubmit'])->name('session.submit');

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

Route::get('/profileMember', function() {
	return view('profileMember');
});

Route::get('/header', function() {
	return view('header');
});

Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);

Route::get(
    '/unregister{date}{sea_id}',
    [PlongeeController::class, 'unregister']
)->middleware('role:2');
//Route::post('/sessionSubmit', [PlongeeController::class, 'setSessionSubmit'])->name('session.submit');




