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

        foreach ($data as $name => $responsabilities) {
            if (!is_array($responsabilities)) {
                continue;
            }

            $name = str_replace('_', ' ', $name);

            foreach ($responsabilities as $value) {
                $values = explode('-', $value);

                if (count($values) < 2) {
                    continue;
                }

                $haveResponsability = $model_responsabilitie->memberHaveResponsability($name, $values[0]);

                if ($values[1] == "true") {
                    if (!$haveResponsability) {
                        $model_responsabilitie->insertResponsability($name, $values[0]);
                    }
                } else {
                    if ($haveResponsability) {
                        $model_responsabilitie->deleteResponsability($name, $values[0]);
                    }
                }
            }
        }

        return $this->setRolls();
    }

    function addSession(){
        return view('addSession', ['members' => (new Member())->getMembers()]);
    }
}