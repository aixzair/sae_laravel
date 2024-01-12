<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Boat;
use App\Models\Member;
use App\Models\Session;

use App\Models\Tables\Plongee;

class SessionManager extends BaseController {

    public function show(Request $request) {
        $sessionModel = new Session();
        $memberModel = new Member();
        $boatModel = new Boat();

        $sessionShow = [];
        $session = $sessionModel->getSession(
            $request->has('SEA_ID') ? $request->input('SEA_ID') : "a",
            $request->has('PLON_DATE') ? $request->input('PLON_DATE') : "a"
        );

        if ($session == null) {
            abort(404);
        }

        $sessionShow['PLON_DATE'] = $session->PLON_DATE;
        $sessionShow['PLON_DIRECTEUR'] = $memberModel->getMemberByEmail($session->PLON_DIRECTEUR)->getIdentity();
        $sessionShow['PLON_SECURITE'] = $memberModel->getMemberByEmail($session->PLON_SECURITE)->getIdentity();
        $sessionShow['PLON_PILOTE'] = $memberModel->getMemberByEmail($session->PLON_PILOTE)->getIdentity();
        $sessionShow['BAT_NOM'] = $boatModel->getBoat($session->BAT_ID)->BAT_NOM;
        $sessionShow['LIEU_NOM'] = $sessionModel->getSiteName($session);
        $sessionShow['MOMENT'] = $sessionModel->getMoment($session);
        //$sessionShow['PLON_EFFECTIFS'] = $sessionModel->getEffectifs($session);

        return view('session/show', [
            "session" => $sessionShow,
            "memberCount" => 0 //$session->PLON_EFFECTIFS
        ]);
    }

    public function membersList(Request $request) {
        return view('session/membersList', [
            "SEA_ID" => ($request->has('SEA_ID') ? $request->input('SEA_ID') : "a"),
            "PLON_DATE" => ($request->has('PLON_DATE') ? $request->input('PLON_DATE') : "a")
        ]);
    }

    public function add() {
        $boatModel = new Boat();
        $memberModel = new Member();

        return view('session/add', [
            "boats" => $boatModel->getBoats(),
            "directors" => $memberModel->getDirectors(),
            "pilots" => $memberModel->getPilots(),
            "securities" => $memberModel->getSecurities()
        ]);
    }
    public function edit(Request $request){
        $sessionModel = new Session();
        $memberModel = new Member();
        $boatModel = new Boat();

        $sessionShow = [];
        $session = $sessionModel->getSession(
            $request->has('SEA_ID') ? $request->input('SEA_ID') : "a",
            $request->has('PLON_DATE') ? $request->input('PLON_DATE') : "a"
        );

        if ($session == null) {
            abort(404);
        }

        $sessionShow['PLON_DATE'] = $session->PLON_DATE;
        $sessionShow['SEA_ID'] = $session->SEA_ID;
        $sessionShow['PLON_DIRECTEUR'] = $memberModel->getMemberByEmail($session->PLON_DIRECTEUR)->getIdentity();
        $sessionShow['PLON_SECURITE'] = $memberModel->getMemberByEmail($session->PLON_SECURITE)->getIdentity();
        $sessionShow['PLON_PILOTE'] = $memberModel->getMemberByEmail($session->PLON_PILOTE)->getIdentity();
        $sessionShow['BAT_NOM'] = $boatModel->getBoat($session->BAT_ID)->BAT_NOM;
        $sessionShow['LIEU_NOM'] = $sessionModel->getSiteName($session);
        $sessionShow['MOMENT'] = $sessionModel->getMoment($session);
        //$sessionShow['PLON_EFFECTIFS'] = $sessionModel->getEffectifs($session);

        return view('session/edit', [
            "session" => $sessionShow,
            "boats" => $boatModel->getBoats(),
            "directors" => $memberModel->getDirectors(),
            "pilots" => $memberModel->getPilots(),
            "securities" => $memberModel->getSecurities()
        ]);
    }

    public function addSubmit(Request $request) {
        $plongee = new Plongee();
        $data = $request->all();

        $memberModel = new Member();
        $boatModel = new Boat();
        $sessionModel = new Session();

        $director = explode(" ", isset($data['director']) ? $data['director'] : "");
        $manager = explode(" ", isset($data['security']) ? $data['security'] : "");
        $driver = explode(" ", isset($data['pilot']) ? $data['pilot'] : "");

        $boat = isset($data['boat']) ? $data['boat'] : "";
        $date = isset($data['day-start'])? $data['day-start'] : "";
        $periode = isset($data['session'])? $data['session'] : "";
        $effective = isset($data['effective'])? $data['effective'] : "";

        switch ($periode) {
            case 'morning': $periode = 1; break;
            case 'afternoon': $periode = 2; break;
            case 'evening': $periode = 3; break;
            default: $periode = 1;
        }

        $plongee->SEA_ID = $periode;
        $plongee->PLON_DATE = $date;

        $plongee->PLON_DIRECTEUR = $memberModel->getMember($director[0], $director[1])->AD_EMAIL;
        $plongee->PLON_SECURITE = $memberModel->getMember($manager[0], $manager[1])->AD_EMAIL;
        $plongee->PLON_PILOTE = $memberModel->getMember($driver[0], $driver[1])->AD_EMAIL;
        $plongee->BAT_ID = $boatModel->getBoatByName($boat)->BAT_ID;
        //$plongee->PLON_EFFECTIFS = $sessionModel->getEffectif($plongee, $date);

        if ($sessionModel->addSession($plongee)) {
            return redirect()->route('session/add')
            ->with('message', "Séance ajoutée avec succès.");
        } else {
            return redirect()->route('session/add')
            ->with('message', "Erreur lors de l ajout de la séance.");
        }
    }

    function editSubmit(Request $request) {

        $plongee = new Plongee();
        $data = $request->all();

        $memberModel = new Member();
        $boatModel = new Boat();
        $sessionModel = new Session();

        $director = explode(" ", isset($data['director']) ? $data['director'] : "");
        $manager = explode(" ", isset($data['security']) ? $data['security'] : "");
        $driver = explode(" ", isset($data['pilot']) ? $data['pilot'] : "");

        $boat = isset($data['boat']) ? $data['boat'] : "";
        $date = isset($data['day-start'])? $data['day-start'] : "";
        $periode = isset($data['session'])? $data['session'] : "";
        $effective = isset($data['effective'])? $data['effective'] : "";

        $primSession = isset($data['pSession'])? $data['pSession'] : "";
        Log::debug($data);
        $primDate = isset($data['pDate'])? $data['pDate'] : "";

        //$primSession = 1;
        //$primDate = '2024-05-27';

        switch ($periode) {
            case 'morning': $periode = 1; break;
            case 'afternoon': $periode = 2; break;
            case 'evening': $periode = 3; break;
            default: $periode = 1;
        }

        $plongee->SEA_ID = $periode;
        $plongee->PLON_DATE = $date;

        // $plongee->primSEA_ID = $primSession;
        // $plongee->primPLON_DATE = $primDate;

        $plongee->PLON_DIRECTEUR = $memberModel->getMember($director[0], $director[1])->AD_EMAIL;
        $plongee->PLON_SECURITE = $memberModel->getMember($manager[0], $manager[1])->AD_EMAIL;
        $plongee->PLON_PILOTE = $memberModel->getMember($driver[0], $driver[1])->AD_EMAIL;
        $plongee->BAT_ID = $boatModel->getBoatByName($boat)->BAT_ID;
        //$plongee->PLON_EFFECTIFS = $sessionModel->getEffectif($plongee, $date);

        if ($sessionModel->editSession($plongee)) {
            return view('welcome');
        } else {
            return view('/session/erroredit');
        }
    }
}
