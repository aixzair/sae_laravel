<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Responsabilite;
use App\Models\Member;

class Controller extends BaseController {

    function setRolls() {
        return view('role', [
            'names' => (new Responsabilite())->getResponsabilities()
        ]);
    }

    function addSession(){
        $members = Member::all();
        return view('addSession', ['members' => $members]);
    }
}