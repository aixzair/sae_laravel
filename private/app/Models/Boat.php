<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Bateau;

class Boat {
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