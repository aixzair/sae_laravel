<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Member {
    function getMembers() : array {
        $members = [];
        $lines = DB::select('SELECT AD_NOM, AD_PRENOM FROM ADHERENT');

        foreach ($line as $lines) {
            $member = new Adherent();
            $member->AD_NOM = $line->AD_NOM;
            $member->AD_PRENOM = $line->AD_PRENOM;
            $members[] = $member;
        }

        return $members;
    }
}