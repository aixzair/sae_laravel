<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Responsabilite {
    function getResponsabilities() : array {
        $responsabilities = [];

        $responsabiliser = DB::select(
            "SELECT AD_NOM, AD_PRENOM, RES_NOM
            FROM RESPONSABILISER
            JOIN ADHERENT USING(AD_EMAIL)
            JOIN RESPONSABILITE USING(RES_ID)"
        );

        foreach ($responsabiliser as $line) {
            $responsabilities[$line->AD_PRENOM . " " . $line->AD_NOM][] = $line->RES_NOM;
        }

        return $responsabilities;
    }
}
