<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Plongee;

class Session {
    function addSession(Plongee $plongee) : bool {
        try {
            return DB::insert(
                "INSERT INTO PLONGEE (
                    SEA_ID, PLON_DATE, PLON_DIRECTEUR, BAT_ID,
                    LIEU_ID, PLON_SECURITE, PLON_PILOTE) 
                VALUES (?,?,?,?,1,?,?)", 
                [
                    $plongee->SEA_ID, $plongee->PLON_DATE, $plongee->PLON_DIRECTEUR, $plongee->BAT_ID,
                    $plongee->PLON_SECURITE, $plongee->PON_PILOTE
                ]
            );
        } catch (\Exception $exception) {
            return false;
        }
    }

}
