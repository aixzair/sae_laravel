<?php
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DeconnexionController extends baseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function logout() {
        Auth::logout();

        return view('\Connexion');
    }

}



?>