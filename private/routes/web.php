<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;
use App\Http\Controllers\SessionManager;

Route::get('/', function () {
    return view('Connexion.html');
});


// SESSION --------------------------------

Route::get('/addSession', 
    [SessionManager::class, 'add']
);

Route::get('/sessionAdded', function () {
    return view('session/addGet');
});

Route::get('/sessionList', function () {
    return view('session/list');
});

// ROLES ----------------------------------

Route::get('/roles',
    [Responsable::class, 'setRolls']
);
Route::post('/rolesSubmit', [Responsable::class, 'setRollsSubmit'])->name('roles.submit');

// AUTRES ---------------------------------

Route::get('/creneau', function () {
    return view('creneau');
});

Route::get('/editSession', function () {
    return view('editSession');
});
