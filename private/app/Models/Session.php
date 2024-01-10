<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Plongee;

class Session {

    function getSession(string $SEA_ID, string $PLON_DATE) : ?Plongee {
        $plongee = new Plongee();

        $lines = DB::select(
            "SELECT * FROM PLONGEE WHERE SEA_ID = ? AND PLON_DATE = ? LIMIT 1",
            [$SEA_ID, $PLON_DATE]
        );

        if (count($lines) == 0) {
            return null;
        }

        foreach ($lines as $line) {
            $plongee->SEA_ID = $SEA_ID;
            $plongee->PLON_DATE = $PLON_DATE;
            $plongee->PLON_DIRECTEUR = $line->PLON_DIRECTEUR;
            $plongee->PLON_SECURITE = $line->PLON_SECURITE;
            $plongee->PLON_PILOTE = $line->PLON_PILOTE;
            $plongee->BAT_ID = $line->BAT_ID;
            $plongee->LIEU_ID = $line->LIEU_ID;
            $plongee->PLON_EFFECTIFS = $line->PLON_EFFECTIFS;
        }

        return $plongee;
    }

    function addSession(Plongee $plongee) : bool {
        try {
            return DB::insert(
                "INSERT INTO PLONGEE (
                    SEA_ID, PLON_DATE, PLON_DIRECTEUR, BAT_ID,
                    LIEU_ID, PLON_SECURITE, PLON_PILOTE) 
                VALUES (?,?,?,?,1,?,?)", 
                [
                    $plongee->SEA_ID, $plongee->PLON_DATE, $plongee->PLON_DIRECTEUR, $plongee->BAT_ID,
                    $plongee->PLON_SECURITE, $plongee->PLON_PILOTE
                ]
            );
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function getSiteName(Plongee $plongee) : string {
        $lines = DB::select(
            "SELECT LIEU_NOM FROM LIEU WHERE LIEU_ID = ? LIMIT 1",
            [$plongee->LIEU_ID]
        );

        foreach ($lines as $line) {
            return $line->LIEU_NOM;
        }

        return "?";
    }

    public function getMoment(Plongee $plongee) : string {
        $lines = DB::select(
            "SELECT SEA_LABEL FROM SEANCE WHERE SEA_ID = ? LIMIT 1",
            [$plongee->SEA_ID]
        );

        foreach ($lines as $line) {
            return $line->SEA_LABEL;
        }

        return "?";
    }
}
