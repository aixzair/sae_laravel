<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;
use App\Http\Controllers\sessionListController;


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

<<<<<<< HEAD
Route::get('/sessionEdited', function () {
    return view('sessionEdited');
});
=======
Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);
>>>>>>> 998549b606e3658f0c02ad9420dce36a7d0c765f

Route::get('/roles',
    [Responsable::class, 'setRolls']
);
Route::post('/rolesSubmit', [Responsable::class, 'setRollsSubmit'])->name('roles.submit');
