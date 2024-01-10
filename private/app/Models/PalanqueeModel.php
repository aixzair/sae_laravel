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
} 

?>