<?php

// requete tableau 1 : 

// SELECT plo.plon_date, adh.ad_nom, lieu_nom, COUNT(adh.ad_email) 
// FROM plongee plo 
// JOIN inscrire ins ON ins.plon_date = plo.plon_date AND ins.sea_id = plo.sea_id
// JOIN adherent adh ON adh.ad_email = plo.plon_directeur
// JOIN lieu lie on lie.lieu_id = plo.lieu_id
// where plo.plon_date = '2024-04-01'
// GROUP BY plo.plon_date, adh.ad_nom, lieu_nom;

// requete tableau 2 :

// SELECT adh.ad_nom FROM plongee plo JOIN adherent adh ON adh.ad_email = plo.PLON_SECURITE where plo.plon_date = '2024-04-01';

// requete tableau 3 :

// public function getPalanqueesNumber(int $sea_id, String $plon_date):int{
//     require("connexion.php");$number = 0;$answer = $bdd->query("SELECT count(*) as nb FROM PALANQUE WHERE SEA_ID = $sea_id AND PLON_DATE = '$plon_date'");
//     while ($data = $answer->fetch()){ $number = $data['nb'];}
//     return $number;}

// requet pour foreach nb de palanque :
    
// SELECT count(pal_id) as nb FROM PALANQUE WHERE SEA_ID = 1 AND PLON_DATE = '2024-04-01';


// info palanquee : (modif pal_id)
// SELECT (pal_heure_fin - pal_heure_debut) as temps, PAL_PRONDEUR_MAX FROM PALANQUE WHERE SEA_ID = 1 AND PLON_DATE = '2024-04-01' and pal_id = 1;


// liste de adherent d'une palanque : 
// select CONCAT(ad_nom, ' ', ad_prenom) AS nom, ad_niveau, role_nom from adherent join role using (role_id) join participer using (ad_email) join palanque using (pal_id) WHERE SEA_ID = 1 AND PLON_DATE = '2024-04-01' and pal_id = 1;

$tableau1 = DB::select(
            "SELECT plo.plon_date, adh.ad_nom, lieu_nom, COUNT(adh.ad_email) 
            FROM plongee plo 
            JOIN inscrire ins ON ins.plon_date = plo.plon_date AND ins.sea_id = plo.sea_id
            JOIN adherent adh ON adh.ad_email = plo.plon_directeur
            JOIN lieu lie on lie.lieu_id = plo.lieu_id
            where plo.plon_date = '2024-04-01'
            GROUP BY plo.plon_date, adh.ad_nom, lieu_nom;"
        );

?>