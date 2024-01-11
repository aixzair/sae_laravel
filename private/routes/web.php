<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Responsable;

use App\Http\Controllers\ConnexionController;
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
// Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);

Route::post('/sessionSubmit', [PlongeeController::class, 'setSessionSubmit'])->name('session.submit');

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
