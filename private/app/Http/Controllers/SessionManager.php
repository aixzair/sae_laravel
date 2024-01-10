<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Boat;
use App\Models\Member;

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

    function edit(){
        return view('session/edit');
    }

    function addSubmit(Request $request) {
        $data = $request->all();
        $memberMobel = new Member();

        $director = explode(" ", isset($data['director']) ? $data['director'] : "");
        $manager = explode(" ", isset($data['security']) ? $data['security'] : "");
        $driver = explode(" ", isset($data['pilot']) ? $data['pilot'] : "");

        $boat = isset($data['boat']) ? $data['boat'] : "";
        $periode = isset($data['session'])? $data['session'] : "";

        switch ($periode) {
            case 'Matin': $periode = 1; break;
            case 'Apres-Midi': $periode = 2; break;
            case 'Soir': $periode = 3; break;
            default: $periode = -1; break;
        }

        $director = $memberMobel->getMember($director[0], $director[1]);
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
        }


        $requete = DB::insert('INSERT INTO PLONGEE 
        (SEA_ID, PLON_DATE, PLON_DIRECTEUR, BAT_ID, LIEU_ID, PLON_SECURITE, PLON_PILOTE) 
        VALUES (?,?,?,?,?,?,?)', 
        [$periode, $_GET['day-start'], $mail_Director, $num_Bat,1, $mail_Manager, $mail_Driver]);    

        return $this->add();
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


        $requete = DB::update('UPDATE PLONGEE SET 
        SEA_ID = ?, PLON_DATE = ? WHERE SEA_ID = ? AND PLON_DATE = ?',
        [$pSession, $pDate, $session, $periode]);

        return $this->edit();
    }
}
