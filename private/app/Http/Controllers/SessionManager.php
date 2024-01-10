<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Boat;
use App\Models\Member;
use App\Models\Session;

use App\Models\Tables\Plongee;


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

    function addSubmit(Request $request) {
        $plongee = new Plongee();
        $data = $request->all();

        $memberMobel = new Member();
        $boatModel = new Boat();
        $sessionModel = new Session();

        $director = explode(" ", isset($data['director']) ? $data['director'] : "");
        $manager = explode(" ", isset($data['security']) ? $data['security'] : "");
        $driver = explode(" ", isset($data['pilot']) ? $data['pilot'] : "");

        $boat = isset($data['boat']) ? $data['boat'] : "";
        $date = isset($data['day-start'])? $data['day-start'] : "";
        $periode = isset($data['session'])? $data['session'] : "";

        switch ($periode) {
            case 'Matin': $periode = 1; break;
            case 'Apres-Midi': $periode = 2; break;
            case 'Soir': $periode = 3; break;
            default: throw new \Exception("période invalide");
        }

        $plongee->SEA_ID = $periode;
        $plongee->PLON_DATE = $date;

        $plongee->PLON_DIRECTEUR = $memberMobel->getMember($director[0], $director[1])->AD_EMAIL;
        $plongee->PLON_SECURITE = $memberMobel->getMember($manager[0], $manager[1])->AD_EMAIL;
        $plongee->PON_PILOTE = $memberMobel->getMember($driver[0], $driver[1])->AD_EMAIL;
        $plongee->BAT_ID = $boatModel->getBoatByName($boat)->BAT_ID;

        $sessionModel->addSession($plongee);

        return $this->add();
    }
}
