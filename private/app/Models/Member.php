<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Adherent;

class Member {

    public function getMember(string $AD_NOM, string $AD_PRENOM) : Adherent {
        $adherent = new Adherent();

        $lines = DB::select(
            "SELECT AD_EMAIL FROM ADHERENT WHERE AD_NOM = ? AND AD_PRENOM = ? LIMIT 1",
            [$AD_NOM, $AD_PRENOM]
        );

        foreach ($lines as $line) {
            $adherent->AD_NOM = $AD_NOM;
            $adherent->AD_PRENOM = $AD_PRENOM;
            $adherent->AD_EMAIL = $line->AD_EMAIL;
        }

        return $adherent;
    }

    public function getMemberByEmail(string $AD_EMAIL) : Adherent {
        $adherent = new Adherent();

        $lines = DB::select(
            "SELECT * FROM ADHERENT WHERE AD_EMAIL = ? LIMIT 1",
            [$AD_EMAIL]
        );

        foreach ($lines as $line) {
            $adherent->AD_NOM = $line->AD_NOM;
            $adherent->AD_PRENOM = $line->AD_PRENOM;
            $adherent->AD_EMAIL = $AD_EMAIL;
        }

        return $adherent;
    }

    public function getMembers() : array {
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

    public function getDirectors() : array {
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

    public function getSecurities() : array {
        $securities = [];
        $lines = DB::select(
            "select AD_NOM, AD_PRENOM from ADHERENT where AD_EMAIL in (
                select AD_EMAIL FROM RESPONSABILISER WHERE RES_ID = (
                    select RES_ID FROM RESPONSABILITE WHERE RES_NOM = \"sécurité\"
                )
            )"
        );

        foreach ($lines as $line) {
            $security = new Adherent();
            $security->AD_NOM = $line->AD_NOM;
            $security->AD_PRENOM = $line->AD_PRENOM;
            $securities[] = $security;
        }

        return $securities;
    }

    public function getPilots() : array {
        $pilots = [];
        $lines = DB::select(
            "select AD_NOM, AD_PRENOM from ADHERENT where AD_EMAIL in (
                select AD_EMAIL FROM RESPONSABILISER WHERE RES_ID = (
                    select RES_ID FROM RESPONSABILITE WHERE RES_NOM = \"pilote\"
                )
            )"
        );

        foreach ($lines as $line) {
            $pilot = new Adherent();
            $pilot->AD_NOM = $line->AD_NOM;
            $pilot->AD_PRENOM = $line->AD_PRENOM;
            $pilots[] = $pilot;
        }

        return $pilots;
    }
}
