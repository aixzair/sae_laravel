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

            foreach ($responsabilities as $responsability) {
                $haveResponsability = $model_responsabilitie->memberHaveResponsability($name, $responsability);
                echo "$name ($responsability) : $haveResponsability <br>";
                if ($request->has("$name.$responsability")) {
                    if (!$haveResponsability) {
                        echo "ajouter responsabilité <br>";
                        $int++;
                    }
                } else {
                    if ($haveResponsability) {
                        echo "retirer responsabilité <br>";
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