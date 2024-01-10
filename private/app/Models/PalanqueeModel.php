<?php

class PalanqueeModel {
    /**
     * Search in the database, the divers who are taking part in a session
     *
     * @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @return array an array with all the participants
     */
    public function getDivers(int $sea_id, String $plon_date):array{
        require("connexion.php");
        $list = array();
        $i = 0;
        $answer = $bdd->query("SELECT ad_prenom, ad_nom, ad_email, ad_niveau from PLONGEE join INSCRIRE using(sea_id, plon_date) join ADHERENT USING(ad_email) where sea_id = $sea_id and plon_date = '$plon_date' and ad_email != plon_securite and AD_EMAIL != plon_pilote;");
        while ($participant = $answer->fetch()){ 
            $list[$i]['ad_nom'] = $participant['ad_nom'];
            $list[$i]['ad_prenom'] = $participant['ad_prenom'];
            $list[$i]['ad_email'] = $participant['ad_email'];
            $list[$i]['ad_niveau'] = $participant['ad_niveau'];
            $i++;
        }
        return $list;
    }

    /**
     * Search the number of palanquees in the database related to the specified dive
     *
     * @param integer $sea_id the session's id
     * @param String $plon_date $plon_date the session's date
     * @return integer the number of palanquees currently registered for this dive
     */
    public function getPalanqueesNumber(int $sea_id, String $plon_date):int{
        require("connexion.php");
        $number = 0;
        $answer = $bdd->query("SELECT count(*) as nb FROM PALANQUE WHERE SEA_ID = $sea_id AND PLON_DATE = '$plon_date'");
        while ($data = $answer->fetch()){ 
            $number = $data['nb'];
        }
        return $number;
    }

    /**
     * Undocumented function
     *
     * @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @param integer $nb_palanquee the number of group to create 
     * @return void
     */
    public function createPalanquees(int $sea_id, String $plon_date, int $nb_palanquee){
        $existing = $this->getPalanqueesNumber($sea_id, $plon_date);
        for($i = $existing; $i < $nb_palanquee; $i++){
            require("connexion.php");
            $req = $bdd->prepare("INSERT INTO (pal_id, sea_id, plon_date) values() ;");
            //echo "INSERT INTO INSCRIRE(SEA_ID, PLON_DATE, AD_EMAIL) VALUES($sea_id, '$plon_date', '$user_email');";
            $req->execute();
        }
    }

    /**
     * Undocumented function
     *
     * @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @return void
     */
    public function deletePalanquees(int $sea_id, String $plon_date){

    }

    /**
     * Search all the palanquees associated with this dive
     *
     *  @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @return array an array containing all the identifiers of all the palanquees
     */
    public function getPalanquees(int $sea_id, String $plon_date):array{
        require("connexion.php");
        $list = array();
        $i = 0;
        $answer = $bdd->query("SELECT pal_id FROM PALANQUE WHERE SEA_ID = $sea_id AND PLON_DATE = '$plon_date'");
        while ($data = $answer->fetch()){
            $list[$i] = $data['pal_id'];
            $i++;
        }
        return $list;
    }


} 

?>