<?php

namespace app\Models;
use Illuminate\Support\Facades\DB;

class PlongeeModel
{
    public function __construct(){

    }

    /**
     * register a diver to a dive session
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @param String $user_email the diver's email 
     * @return void
     */
    public function register(int $sea_id, String $plon_date, String $user_email){

        DB::insert(
            "INSERT INTO INSCRIRE(SEA_ID, PLON_DATE, AD_EMAIL) 
            VALUES (? , ?, ?)",
            [$sea_id, $plon_date, $user_email]);
        DB::commit();
    }

    /**
     * Unregisters user from selected diving session
     *
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @param String $user_email the diver's email 
     * @return void
     */
    public function unregister(int $sea_id, String $plon_date, String $user_email){
        DB::delete(
            "DELETE FROM INSCRIRE WHERE SEA_ID = ? and PLON_DATE = ? and AD_EMAIL = ?
            ",
            [$sea_id, $plon_date, $user_email]
        );
        DB::commit();
        //dd(DB::getQueryLog());
    }

    /**
     * searches all of the diving sessions for the year
     * 
     * @return a list of all the upcomings dives
     */
    public function list(){
        $answer = DB::SELECT(
            "SELECT PLON_DATE, SEA_ID, PLON_DEBUT, PLON_FIN, PLON_EFFECTIFS_MAX, PLON_EFFECTIFS_MIN, PLON_NIVEAU
                    FROM PLONGEE
                    ORDER BY PLON_DATE ASC");
        return $answer;
    }

    public function listDivers(int $sea_id, String $plon_date)
    {
        $answer = DB::SELECT(
            "SELECT AD_PRENOM, AD_NOM, AD_NIVEAU, PLON_EFFECTIFS_MIN, PLON_EFFECTIFS_MAX
                    FROM INSCRIRE
                    JOIN ADHERENT USING (AD_EMAIL)
                    JOIN PLONGEE USING (SEA_ID, PLON_DATE)
                    WHERE SEA_ID = ? AND PLON_DATE = ?",
                    [$sea_id, $plon_date]);
        return $answer;
    }

    /**
     * check if a diving session is complete
     * 
     * @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @return boolean true if the dive is complete in participants, false otherwise
     */
    public function isComplete(int $sea_id, String $plon_date):bool{
        $answer = DB::SELECT(
            "SELECT PLON_EFFECTIFS_MAX
                    FROM PLONGEE
                    WHERE SEA_ID = ? AND PLON_DATE = ?
                    ORDER BY PLON_EFFECTIFS_MAX ASC",
                    [$sea_id, $plon_date]);
        $max = array_shift($answer);

        $answer = DB::SELECT(
            "SELECT COUNT(*) AS nb FROM INSCRIRE
                    WHERE SEA_ID = ? AND PLON_DATE = ?",
                    [$sea_id, $plon_date]);
        $inscrits = array_shift($answer);
        return $inscrits->nb >= $max->PLON_EFFECTIFS_MAX;
    }

    /**
     * Check if a user is registered on a diving session
     *
     * @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @param String $user_email the user's email address
     * @return boolean true if the user is already registered for this session, false otherwise
     */
    public function isRegistered(int $sea_id, String $plon_date, String $user_email){
        $answer = DB::SELECT(
            "SELECT count(*) as nb 
            FROM INSCRIRE 
            WHERE sea_id = ? and PLON_DATE = ? and AD_EMAIL = ?",
                    [$sea_id, $plon_date, $user_email]);
            $inscrits = array_shift($answer);
        return $inscrits->nb > 0;
    }

    /**
     * Checks if user's level is high enough for the minimum level of selected dive session
     *
     * @param integer $sea_id
     * @param String $plon_date
     * @param String $user_email
     * @return boolean
     */
    public function isRightLevel(int $sea_id, String $plon_date, String $user_email){
        $answer = DB::SELECT(
            "SELECT count(*) as nb 
            FROM ADHERENT, PLONGEE
            WHERE SEA_ID = ? and PLON_DATE = ? and AD_EMAIL = ? AND PLON_NIVEAU <= AD_NIVEAU",
                    [$sea_id, $plon_date, $user_email]);
            $nivSuff = array_shift($answer);
        return $nivSuff->nb <> 0;
    }
    /**
     * Checks whether given diving is fully set and valid to register to
     *
     * @param integer $sea_id
     * @param String $plon_date
     * @return boolean
     */
    public function isValid(int $sea_id, String $plon_date):bool{
        $answer = DB::SELECT(
            "SELECT count(*)  as nb
            FROM PLONGEE 
            WHERE sea_id = ? and PLON_DATE = ? AND 
            (PLON_DIRECTEUR IS NULL OR BAT_ID IS NULL OR LIEU_ID IS NULL OR PLON_SECURITE IS NULL OR PLON_PILOTE IS NULL OR PLON_EFFECTIFS_MAX IS NULL OR PLON_EFFECTIFS_MIN IS NULL
            OR PLON_OBSERVATION IS NULL OR PLON_DEBUT IS NULL OR PLON_DEBUT IS NULL OR PLON_NIVEAU IS NULL)",
                    [$sea_id, $plon_date]);
            $valid = array_shift($answer);
            return $valid->nb ==0;
    }
}

?>