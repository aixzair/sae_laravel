<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Models\Boat;

class SessionManager extends BaseController {

    function add() {
        $boatModel = new Boat();

        return view('session/add', [
            "boats" => $boatModel->getBoats()
        ]);
    }
}