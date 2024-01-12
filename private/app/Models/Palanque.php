<?php 
// app/Models/Palanque.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Palanque extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'palanque';

    // Specify the fillable attributes for mass assignment
    protected $fillable = ['pal_id', 'sea_id', 'pal_effectifs', 'pal_heure_debut', 'pal_heure_fin', 'pal_prondeur_max', 'plon_date'];
	

    // Disable automatic timestamps for this model
	public $timestamps = false;
}


?>