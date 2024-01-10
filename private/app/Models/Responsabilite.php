<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Responsabilite {
    function getResponsabilities() : array {
        $responsabilities = [];

        $responsabiliser = DB::select(
            "SELECT AD_NOM, AD_PRENOM, RES_NOM
            FROM ADHERENT
            LEFT JOIN RESPONSABILISER USING(AD_EMAIL)
            LEFT JOIN RESPONSABILITE USING(RES_ID)"
        );

        foreach ($responsabiliser as $line) {
            $responsabilities[$line->AD_PRENOM . " " . $line->AD_NOM][] = $line->RES_NOM;
        }

        return $responsabilities;
    }

    function addRole(string $email, string $name) : bool {
        try {
            return DB::insert(
                "INSERT INTO RESPONSABILISER (AD_EMAIL, RES_ID)
                VALUES (
                    ?,
                    (SELECT RES_ID FROM RESPONSABILITE WHERE RES_NOM = ?)
                )",
                [$email, $name]
            );    
        } catch (\Exception $exception) {
            return false;
        }
    }

    function memberHaveResponsability(string $idendity, string $responsability) : bool {
        $lines = DB::select(
            "SELECT RES_ID
            FROM RESPONSABILISER
            JOIN ADHERENT USING(AD_EMAIL)
            JOIN RESPONSABILITE USING(RES_ID)
            WHERE
            ? = CONCAT(AD_PRENOM, ' ', AD_NOM)
            AND ? = RES_NOM",
            [$idendity, $responsability]
        );

        foreach ($lines as $line) {
            return true;
        }

        return false;
    }

    function insertResponsability(string $idendity, string $responsability) : bool {
        try {
            DB::insert(
                "INSERT INTO RESPONSABILISER (RES_ID, AD_EMAIL) VALUES (
                    (SELECT RES_ID FROM RESPONSABILITE WHERE RES_NOM = ?),
                    (SELECT AD_EMAIL FROM ADHERENT WHERE CONCAT(AD_PRENOM, ' ', AD_NOM) = ?)
                )",
                [$responsability, $idendity]
            );
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    function deleteResponsability(string $idendity, string $responsability) {
        try {
            DB::insert(
                "DELETE FROM RESPONSABILISER WHERE
                RES_ID = (SELECT RES_ID FROM RESPONSABILITE WHERE RES_NOM = ?)
                AND AD_EMAIL = (SELECT AD_EMAIL FROM ADHERENT WHERE CONCAT(AD_PRENOM, ' ', AD_NOM) = ?)",
                [$responsability, $idendity]
            );
            DB::commit();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}
