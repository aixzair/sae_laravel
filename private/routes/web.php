<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;

Route::get('/', function () {
    return view('Connexion.html');
});

Route::get('roles',
    [Responsable::class, 'setRolls']
);
Route::get('rolesSubmit',
    [Responsable::class, 'setRollsSubmit']
);
