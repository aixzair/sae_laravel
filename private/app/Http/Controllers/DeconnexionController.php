<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as baseController;
//use Illuminate\Support\Facades\DB;

class DeconnexionController extends baseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function deconnect() {

        Auth::logout();

        return redirect('/');

        
}

}



?>