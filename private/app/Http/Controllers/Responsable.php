<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use App\Models\Responsabilite;

class Controller extends BaseController {

    function setRolls() {
        return view('role', [
            'names' => (new Responsabilite())->getResponsabilities()
        ]);
    }
}