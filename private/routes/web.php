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

use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\DeconnexionController;
use App\Http\Controllers\PlongeeController;
use App\Http\Controllers\Responsable;

use App\Http\Controllers\ConnexionController;
use app\Http\Controllers\PlongeeController;
use App\Http\Controllers\sessionListController;



Route::get('/', function () {
    return view('connexion');
});

<<<<<<< HEAD
=======
// CONNEXION -----------------------------

Route::match(['post'],'/gestionAuthentification', [ConnexionController::class, 'index']);

Route::get('/Connexion', function() {
	return view('Connexion');
});

Route::get('/deconnexion', 
    [DeconnexionController::class, 'deconnect']
);

>>>>>>> c8a7244595f852c2c43d629ac6e5aec49eaee5ab
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

<<<<<<< HEAD
Route::get('/creneau', function () {
    return view('creneau');
});
// Route::get('/sessionList/{month}', [sessionListController::class, 'getMonthlySessions']);
=======
Route::get('/register/{date}/{sea_id}', [PlongeeController::class, 'register']);
Route::get('/unregister{date}{sea_id}', [PlongeeController::class, 'unregister']);
//Route::post('/sessionSubmit', [PlongeeController::class, 'setSessionSubmit'])->name('session.submit');
>>>>>>> c8a7244595f852c2c43d629ac6e5aec49eaee5ab

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

<<<<<<< HEAD
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
=======
Route::get('/profileSecretary', function() {
	return view('profileSecretary');
})->middleware('role:1');

>>>>>>> c8a7244595f852c2c43d629ac6e5aec49eaee5ab
