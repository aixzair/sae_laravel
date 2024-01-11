<?php

namespace app\Models;
use Illuminate\Support\Facades\DB;

class PlongeeModel
{
    public function __construct(){

    }

    /**
     * register a diver to a dive
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @param String $user_email the diver's email 
     * @return void
     */
    public function register(int $sea_id, String $plon_date, String $user_email){
        /*require("connexion.php");
        $req = $bdd->prepare("INSERT INTO INSCRIRE(sea_id, plon_date, ad_email) VALUES($sea_id, '$plon_date', '$user_email');");
        //echo "INSERT INTO INSCRIRE(SEA_ID, PLON_DATE, AD_EMAIL) VALUES($sea_id, '$plon_date', '$user_email');";
        $req->execute();*/

        DB::insert(
            "INSERT INTO INSCRIRE(SEA_ID, PLON_DATE, AD_EMAIL) 
            VALUES (? , ?, ?)",
            [$sea_id, $plon_date, $user_email]);
        DB::commit();

        //refresh page?
    }

    /**
     * Undocumented function
     *
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @param String $user_email the diver's email 
     * @return void
     */
    public function unregister(int $sea_id, String $plon_date, String $user_email){
        
        DB::delete(
            "DELETE FROM INSCRIRE WHERE SEA_ID = ?, PLON_DATE = ?, AD_EMAIL = ?
            )",
            [$sea_id, $plon_date, $user_email]
        );
        DB::commit();

        //refresh ?
    }

    /**
     * search all of the upcomings diving sessions
     * 
     * @return a list of all the upcomings dives
     */
    public function list(){
        

        //$answer = $bdd->query("select sea_id, plon_date, bat_id, plon_effectifs, plon_observation, lieu_nom, plon_debut, plon_fin from PLONGEE join LIEU using (lieu_id) order by plon_date;");
        $answer = DB::SELECT(
            "SELECT PLON_DATE, SEA_ID, PLON_DEBUT, PLON_FIN, PLON_EFFECTIFS_MAX, PLON_EFFECTIFS_MIN, PLON_NIVEAU
                    FROM PLONGEE
                    ORDER BY PLON_DATE ASC");
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
        //SELECT count(*) FROM `INSCRIRE` WHERE sea_id = 1 and PLON_DATE = '2024-04-01' and AD_EMAIL = 'abigail.garcia@gmail.com' 
        /*require("connexion.php");
        $answer = $bdd->query("SELECT count(*) as nb FROM INSCRIRE WHERE sea_id = $sea_id and PLON_DATE = '$plon_date' and AD_EMAIL = '$user_email';");
        while ($session = $answer->fetch()){ 
            if($session['nb'] > 0){
                return true;
            };
        }*/
        $answer = DB::SELECT(
            "SELECT count(*) as nb 
            FROM INSCRIRE 
            WHERE sea_id = ? and PLON_DATE = ? and AD_EMAIL = ?",
                    [$sea_id, $plon_date, $user_email]);
            $inscrits = array_shift($answer);
        return $inscrits->nb > 0;
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