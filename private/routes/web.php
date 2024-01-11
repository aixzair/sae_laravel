<?php

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

Route::get('/profileMember', function() {
	return view('profileMember');
});

Route::get('/header', function() {
	return view('header');
});

Route::get('\connectionError', function() {
	return view('connectionError');
});

Route::get('/profilResp', function() {
	return view('profilResp');
});

Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);


//Route::match(['get', 'post'],'/gestionAuthentification', function() {
	//return view('gestionAuthentification');
//});
