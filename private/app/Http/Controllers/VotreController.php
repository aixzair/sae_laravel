<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\DB;

class VotreController extends Controller {

    public function getNbDives() : string  {
        $resultat = "";
        $lines = DB::select(
            "SELECT AD_NBPLONGEES_ANS FROM ADHERENT WHERE AD_EMAIL = ? LIMIT 1",
            [session('email')]
        );

        foreach ($lines as $line) {
            $resultat = $line->AD_NBPLONGEES_ANS;
        }

        session(['nb_plongees' => $resultat]);
        
        return $resultat;
    }
}