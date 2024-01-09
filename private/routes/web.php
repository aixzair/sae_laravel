<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;

Route::get('/', function () {
    return view('welcome');
});

Route::get('role',
    [Responsable::class, 'setRolls']
);
Route::get('roleSubmit',
    [Responsable::class, 'setRollsSubmit']
);
