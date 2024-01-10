<?php

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
        require("connexion.php");
        $req = $bdd->prepare("INSERT INTO INSCRIRE(sea_id, plon_date, ad_email) VALUES($sea_id, '$plon_date', '$user_email');");
        //echo "INSERT INTO INSCRIRE(SEA_ID, PLON_DATE, AD_EMAIL) VALUES($sea_id, '$plon_date', '$user_email');";
        $req->execute();
    }

    /**
     * @return a list of all the upcomings dives
     */
    public function list(){
        require("connexion.php");

        $answer = $bdd->query("select sea_id, plon_date, bat_id, plon_effectifs, plon_observation, lieu_nom, plon_debut, plon_fin from PLONGEE join LIEU using (lieu_id) order by plon_date;");

        return $answer;
    }

    /**
     * check if a dive is complete
     * @return boolean true if the dive is complete in participants, false otherwise
     */
    public function isComplete(int $sea_id, String $plon_date){
        require("connexion.php");
        $answer = $bdd->query("select plon_effectifs from PLONGEE where sea_id = $sea_id and plon_date = '$plon_date';");
        $max = 0;
        while ($session = $answer->fetch()){ 
            $max = $session['plon_effectifs'];
        }

        $answer = $bdd->query("select count(*) as inscrits from INSCRIRE where sea_id = $sea_id and plon_date = '$plon_date';");
        $inscrits = 0;
        while ($session = $answer->fetch()){ 
            $inscrits = $session['inscrits'];
        }
        return $inscrits >= $max;
    }
}

?>