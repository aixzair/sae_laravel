<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Responsabilite;
use App\Models\Member;

class Responsable extends BaseController {

    function setRolls() {
        return view('roles', [
            'names' => (new Responsabilite())->getResponsabilities()
        ]);
    }

    function addSession(){
        $members = Member::all();
        return view('addSession', ['members' => $members]);
    }

    function setRollsSubmit() {
        return view('roles');
    }
}