<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use App\Models\Tables\Bateau;

/**
 * The Model makes request to table BATEAU
 */
class Boat {

    /**
     * Get a boat in the data base with the id
     * 
     * @param string $BAT_ID the id of the boat
     * 
     * @return BATEAU a boat
     */
    function getBoat(string $BAT_ID) : Bateau {
        $boat = new Bateau();
        $lines = DB::select(
            "SELECT BAT_NOM, BAT_ID FROM BATEAU WHERE BAT_ID = ? LIMIT 1",
            [$BAT_ID]
        );

        foreach ($lines as $line) {
            $boat->BAT_ID = $line->BAT_ID;
            $boat->BAT_NOM = $line->BAT_NOM;
        }

        return $boat;
    }

    /**
     * Get a boat by this name
     * 
     * @param string $BAT_NOM his name
     * 
     * @return BATEAU a boat
     */
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

    /**
     * Gets all boats
     * 
     * @return array of boats
     */
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