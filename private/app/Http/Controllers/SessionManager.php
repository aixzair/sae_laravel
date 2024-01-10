<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Routing\Controller as BaseController;

use App\Models\Boat;

class SessionManager extends BaseController {

    function add() {
        $boatModel = new Boat();
        $memberMobel = new Member();

        return view('session/add', [
            "boats" => $boatModel->getBoats(),
            "directors" => $memberMobel->getDirectors(),
            "pilots" => $memberMobel->getPilots(),
            "securities" => $memberMobel->getSecurities()
        ]);
    }
}