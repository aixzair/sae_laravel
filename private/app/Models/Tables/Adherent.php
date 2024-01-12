<?php

namespace App\Models\Tables;

/**
 * This Class represent the table of ADHERENT in the data-base
 */
class Adherent {
    public string $AD_NOM;
    public string $AD_PRENOM;
    public string $AD_EMAIL;

    public function getIdentity() : string {
        return $this->AD_NOM . " " . $this->AD_PRENOM;
    }

}