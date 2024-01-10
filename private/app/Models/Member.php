<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Adherent;

class Member {
    function getMembers() : array {
        $members = [];
        $lines = DB::select('SELECT AD_NOM, AD_PRENOM FROM ADHERENT');

        foreach ($lines as $line) {
            $member = new Adherent();
            $member->AD_NOM = $line->AD_NOM;
            $member->AD_PRENOM = $line->AD_PRENOM;
            $members[] = $member;
        }

        return $members;
    }

    function getDirectors() : array {
        $directors = [];
        $lines = DB::select(
            "select AD_NOM, AD_PRENOM from ADHERENT where AD_EMAIL in (
                select AD_EMAIL FROM RESPONSABILISER WHERE RES_ID = (
                    select RES_ID FROM RESPONSABILITE WHERE RES_NOM = \"directeur\"
                )
            )"
        );

        foreach ($lines as $line) {
            $director = new Adherent();
            $director->AD_NOM = $line->AD_NOM;
            $director->AD_PRENOM = $line->AD_PRENOM;
            $directors[] = $director;
        }

        return $directors;
    }
}