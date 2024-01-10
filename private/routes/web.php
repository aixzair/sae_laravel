<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;

Route::get('/', function () {
    return view('Connexion.html');
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

Route::get('/roles',
    [Responsable::class, 'setRolls']
);
Route::post('/rolesSubmit', [Responsable::class, 'setRollsSubmit'])->name('roles.submit');
