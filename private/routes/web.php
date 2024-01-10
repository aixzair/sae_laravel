<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;
use App\Http\Controllers\SessionManager;

Route::get('/', function () {
    return view('Connexion.html');
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

Route::get('/editSession', function () {
    return view('editSession');
});
