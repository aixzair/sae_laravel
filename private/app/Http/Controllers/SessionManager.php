<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

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

        return view('session/show', [
            "session" => $sessionShow,
            "memberCount" => $session->PLON_EFFECTIFS
        ]);
    }

    public function add() {
        $boatModel = new Boat();
        $memberMobel = new Member();

        return view('session/add', [
            "boats" => $boatModel->getBoats(),
            "directors" => $memberMobel->getDirectors(),
            "pilots" => $memberMobel->getPilots(),
            "securities" => $memberMobel->getSecurities()
        ]);
    }
    public function edit(){
        return view('session/edit');
    }

    public function addSubmit(Request $request) {
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
            default: $periode = 1;
        }

        $plongee->SEA_ID = $periode;
        $plongee->PLON_DATE = $date;

        $plongee->PLON_DIRECTEUR = $memberMobel->getMember($director[0], $director[1])->AD_EMAIL;
        $plongee->PLON_SECURITE = $memberMobel->getMember($manager[0], $manager[1])->AD_EMAIL;
        $plongee->PLON_PILOTE = $memberMobel->getMember($driver[0], $driver[1])->AD_EMAIL;
        $plongee->BAT_ID = $boatModel->getBoatByName($boat)->BAT_ID;

        if ($sessionModel->addSession($plongee)) {
            return view('welcome');
        } else {
            return $this->add();
        }
    }

    function editSubmit(Request $request) {

        $data = $request->all();
        $memberMobel = new Member();

        /*$director = explode(" ", isset($data['director']) ? $data['director'] : "");
        $manager = explode(" ", isset($data['security']) ? $data['security'] : "");
        $driver = explode(" ", isset($data['pilot']) ? $data['pilot'] : "");

        $boat = isset($data['boat']) ? $data['boat'] : "";*/

        $periode = isset($data['session'])? $data['session'] : "";
        $date = isset($data['day-start'])? $data['day-start'] : "";
        $primarySession = isset($data['pSession'])? $data['pSession'] : "";
        $primaryDate = isset($data['pDate'])? $data['pDate'] : "";

        switch ($periode) {
            case 'Matin': $periode = 1; break;
            case 'Apres-Midi': $periode = 2; break;
            case 'Soir': $periode = 3; break;
            default: $periode = -1; break;
        }

        /*$director = $memberMobel->getMember($director[0], $director[1]);
        $manager = $memberMobel->getMember($manager[0], $manager[1]);
        $driver = $memberMobel->getMember($driver[0], $driver[1]);

        $mail_Director = 1;
        $mail_Manager = 1;
        $mail_Driver = 1;
        $num_Bat = 1;
        $periode = 1;

        $requete = DB::Select('SELECT * FROM BATEAU WHERE BAT_NOM = :Nom', ['Nom' => $num_Bat]);
        foreach($requete as $member){
            $mail_Bat =  $member->BAT_ID;
        }*/


        /*$requete = DB::update('UPDATE PLONGEE SET 
        SEA_ID = ?, PLON_DATE = ? WHERE SEA_ID = ? AND PLON_DATE = ?',
        [$pSession, $pDate, $session, $periode]);*/

        return $this->edit();
    }
}
