<?php

class PalanqueeModel {
    /**
     * Search in the database, the divers who are taking part in a session
     *
     * @param integer $sea_id the session's id
     * @param String $plon_date the session's date
     * @return array an array with all the participants
     */
    public function getDivers(int $sea_id, String $plon_date){
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
} 

?>