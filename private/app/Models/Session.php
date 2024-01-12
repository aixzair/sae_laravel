<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Plongee;
use App\Models\Tables\Adherent;

/**
 * Managed a session (drives)
 */
class Session {

    /**
     * Get a session
     * 
     * @param string $SEA_ID id
     * @param string $PLON_DATE the date
     * 
     * @return ?Plongee a session or not
     */
    function getSession(string $SEA_ID, string $PLON_DATE) : ?Plongee {
        $plongee = new Plongee();

        $lines = DB::select(
            "SELECT * FROM PLONGEE WHERE SEA_ID = ? AND PLON_DATE = ? LIMIT 1",
            [$SEA_ID, $PLON_DATE]
        );

        if (count($lines) == 0) {
            return null;
        }

        foreach ($lines as $line) {
            $plongee->SEA_ID = $SEA_ID;
            $plongee->PLON_DATE = $PLON_DATE;
            $plongee->PLON_DIRECTEUR = $line->PLON_DIRECTEUR;
            $plongee->PLON_SECURITE = $line->PLON_SECURITE;
            $plongee->PLON_PILOTE = $line->PLON_PILOTE;
            $plongee->BAT_ID = $line->BAT_ID;
            $plongee->LIEU_ID = $line->LIEU_ID;
            $plongee->PLON_EFFECTIFS_MAX = $line->PLON_EFFECTIFS_MAX;
        }

        return $plongee;
    }

    /**
     * Add a session
     * 
     * @param Plongee $plongee the session
     * 
     * @return bool succes
     */
    function addSession(Plongee $plongee) : bool {
        try {
            return DB::insert(
                "INSERT INTO PLONGEE (
                    SEA_ID, PLON_DATE, PLON_DIRECTEUR, BAT_ID,
                    LIEU_ID, PLON_SECURITE, PLON_PILOTE) 
                VALUES (?,?,?,?,1,?,?)", 
                [
                    $plongee->SEA_ID, $plongee->PLON_DATE, $plongee->PLON_DIRECTEUR, $plongee->BAT_ID,
                    $plongee->PLON_SECURITE, $plongee->PLON_PILOTE
                ]
            );
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Eddit a session
     * 
     * @param Plongee $plongee the session
     * 
     * @return bool succes
     */
    function editSession(Plongee $plongee) : bool {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        try {
            return DB::update(
                "UPDATE PLONGEE SET
                    PLON_DIRECTEUR = ?, 
                    BAT_ID = ?,
                    LIEU_ID = ?, 
                    PLON_SECURITE = ?, 
                    PLON_PILOTE = ?
                    WHERE SEA_ID = ? AND PLON_DATE = ? ", 

                [
                    $plongee->PLON_DIRECTEUR,
                    $plongee->BAT_ID,
                    1,
                    $plongee->PLON_SECURITE,
                    $plongee->PLON_PILOTE,
                    $plongee->SEA_ID,
                    $plongee->PLON_DATE
                ]
            );
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Get the site name's of a session
     * 
     * @param Plongee $plongee the session
     * 
     * @return string the name
     */
    public function getSiteName(Plongee $plongee) : string {
        $lines = DB::select(
            "SELECT LIEU_NOM FROM LIEU WHERE LIEU_ID = ? LIMIT 1",
            [$plongee->LIEU_ID]
        );

        foreach ($lines as $line) {
            return $line->LIEU_NOM;
        }

        return "?";
    }

    /**
     * Get the moment of a session
     * 
     * @param Plongee $plongee the session
     * 
     * @return string moment
     */
    public function getMoment(Plongee $plongee) : string {
        $lines = DB::select(
            "SELECT SEA_LABEL FROM SEANCE WHERE SEA_ID = ? LIMIT 1",
            [$plongee->SEA_ID]
        );

        foreach ($lines as $line) {
            return $line->SEA_LABEL;
        }

        return "?";
    }

    /**
     * Get securities
     * 
     * @return array securities
     */
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

    public function getEffectif(string $SEA_ID, string $PLON_DATE) : array {
        $effective = [];

        $lines = DB::select(
            "SELECT * FROM PLONGEE WHERE SEA_ID = ? AND PLON_DATE = ? LIMIT 1",
            [$SEA_ID, $PLON_DATE]
        );

        foreach ($lines as $line) {
            $plongee = new Plongee();
            $plongee->PLON_EFFECTIFS_MAX = $line->PLON_EFFECTIFS_MAX;
            $plongee->SEA_ID = $SEA_ID;
            $plongee->PLON_DATE = $PLON_DATE;

            $effective[] = $plongee;
        }

        return $effective;
    }

    /**
     * Get the number of dives of a member
     * 
     * @param string $AD_EMAIL
     * 
     * @return string the number of a drives
     */
    public static function getNbDives(string $AD_EMAIL) : string  {
        $lines = DB::select(
            "SELECT AD_NBPLONGEES_ANS FROM ADHERENT WHERE AD_EMAIL = ? LIMIT 1",
            [$AD_EMAIL]
        );

        foreach ($lines as $line) {
            return $line->AD_NBPLONGEES_ANS;
        }
        
        return "-1";
    }

}
