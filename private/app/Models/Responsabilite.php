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

    function addRole(string $email, string $nom) : bool {
        try {
            return DB::insert(
                "INSERT INTO RESPONSABILISER (AD_EMAIL, RES_ID)
                VALUES (
                    ?,
                    (SELECT RES_ID FROM RESPONSABILITE WHERE RES_NOM = ?)
                )",
                [$email, $nom]
            );    
        } catch (\Exception $exception) {
            return false;
        }
    }
}
