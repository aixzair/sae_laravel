<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Responsabilite;
use App\Models\Member;

class Responsable extends BaseController {

    function setRolls(string $message = "") {
        return view('roles', [
            'names' => (new Responsabilite())->getResponsabilities(),
            'message' => $message
        ]);
    }

    function setRollsSubmit(Request $request) {
        $data = $request->all();
        $model_responsabilitie = new Responsabilite();

        $int = 0;

        foreach ($data as $name => $responsabilities) {
            if (!is_array($responsabilities)) {
                continue;
            }
            var_dump($responsabilities);
            foreach ($responsabilities as $responsability) {
                echo "a = " . $responsability;
                $haveResponsability = $model_responsabilitie->memberHaveResponsability($name, $responsability);
                if ($request->has("$name.$responsability")) {
                    if (!$haveResponsability) {
                        echo "ajouter responsabilité";
                        $int++;
                    }
                } else {
                    if ($haveResponsability) {
                        echo "retirer responsabilité";
                        $int--;
                    }
                }
            }
        }

        // return $this->setRolls($int . "");
    }

    function addSession(){
        return view('addSession', ['members' => (new Member())->getMembers()]);
    }
}