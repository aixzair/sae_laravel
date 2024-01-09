<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Models\Responsabilite;

class Responsable extends BaseController {

    function setRolls() {
        return view('role', [
            'names' => (new Responsabilite())->getResponsabilities()
        ]);
    }

    function setRollsSubmit() {
        

        return view('role');
    }
}