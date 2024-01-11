<?php 
// app/Models/Palanque.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palanque extends Model
{
    use HasFactory;

    protected $table = 'palanque';

    protected $fillable = ['pal_id', 'sea_id', 'pal_effectifs', 'pal_heure_debut', 'pal_heure_fin', 'pal_prondeur_max', 'plon_date'];
	
	public $timestamps = false;
}


?>