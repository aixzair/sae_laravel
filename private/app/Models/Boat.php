<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Bateau;

class Boat {

    function getBoatByName(string $BAT_NOM) : Bateau {
        $boat = new Bateau();
        $lines = DB::select(
            "SELECT BAT_NOM, BAT_ID FROM BATEAU WHERE BAT_NOM = ? LIMIT 1",
            [$BAT_NOM]
        );

        foreach ($lines as $line) {
            $boat->BAT_ID = $line->BAT_ID;
            $boat->BAT_NOM = $line->BAT_NOM;
        }

        return $boat;
    }

    function getBoats() : array {
        $boats = [];
        $lines = DB::Select("SELECT * FROM BATEAU");

        foreach ($lines as $line) {
            $boat = new Bateau();
            $boat->BAT_NOM = $line->BAT_NOM;
            $boats[] = $boat;
        }

        return $boats;
    }
}