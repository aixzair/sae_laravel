<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function getAdherentsPalanquee($seaId, $plonDate, $palId)//recupère les adhérents d'une palanque d'une plongé précise
    {
        $adherents = DB::select("
            SELECT ad.ad_nom, ad.ad_prenom, ad.ad_niveau
            FROM adherent ad
            JOIN participer p ON ad.ad_email = p.ad_email
            JOIN palanque pal ON p.pal_id = pal.pal_id
            WHERE pal.SEA_ID = ? AND pal.PLON_DATE = ? AND pal.pal_id = ?
        ", [$seaId, $plonDate, $palId]);

        return $adherents;
    }
	
	   public function getAdherentsInscription($seaId, $plonDate)
    {
        $adherentsInscription = DB::select("
            SELECT AD_NOM, AD_PRENOM, AD_EMAIL
            FROM adherent
            JOIN inscrire USING (ad_email)
            JOIN plongee USING (sea_id, plon_date)
            WHERE sea_id = ? AND plon_date = ?
        ", [$seaId, $plonDate]);

        return response()->json($adherentsInscription);
    }
}
?>
