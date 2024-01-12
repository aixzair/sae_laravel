<?php
// app/Http/Controllers/PalanqueController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palanque;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PalanqueController extends Controller
{

    // Display the main view of palanquées
    public function index()
    {
        return view('palanquees');
    }

    // Get the form for the number of palanquées
    public function getPalanqueDetailsForm(Request $request)
    {
		Log::debug("début");
        $request->validate([
            'nb_palanque' => 'required|integer|min:1',
        ]);
		Log::debug("après validate");

        // Get the values of the input
        $nb_palanque = $request->input('nb_palanque');
		Log::debug("nb=$nb_palanque");


        // If the number of palanquées is not zero, display the view with the number of palanquées
		if($nb_palanque!=0){
			return view('palanquees', compact('nb_palanque'));
		}
		Log::debug("après if");

        // Redirect to the 'palanquees.index' route if the number of palanquées is zero
		return redirect()->route('palanquees.index');
    }


    // Store details of palanquées
    public function storePalanqueDetails(Request $request)
    {
		Log::debug("début store");
		
		$nb_palanque = $request->input('nb_palanquee');
		

        // Get the largest existing palanquée ID
		$max_idpalanque = Palanque::max('pal_id')+1;
		

        // Array to store created palanquée IDs
		$max_idpalanques = [];
		
		
		// Loop to create palanquées with the provided details
        for ($i = 1; $i < $nb_palanque+1; $i++) {
			$max_idpalanques[]=$max_idpalanque;
            Palanque::create([
				'pal_id' => $max_idpalanque,
				'sea_id'=>1,
				'plon_date'=>'2024-04-01',
                'pal_effectifs' => $request->input('effectif')[$i],
                'pal_heure_debut' => $request->input('heure_min')[$i],
                'pal_heure_fin' => $request->input('heure_max')[$i],
                'pal_prondeur_max' => $request->input('profondeur')[$i],
            ]);
			$max_idpalanque++;
			
        }
		
        // Get the list of registered members for the specified date
		$listeadherents=DB::select('SELECT AD_NOM,AD_PRENOM, AD_EMAIL FROM ADHERENT JOIN INSCRIRE USING (AD_EMAIL) WHERE SEA_ID=? AND PLON_DATE=?',[1,'2024-04-01']);
		
        // Display the 'palanquees' view with registered participants and palanquée details
		return view('palanquees', ['participantsInscrits' => $listeadherents,'nbPalanque'=>$nb_palanque,'max_idpalanques' => $max_idpalanques]);

    }
	

    // Store details of registered members
	public function storeAdherentDetails(Request $request)
	{
		$nb_palanque = $request->input('nb_adherent');

        // Loop to insert members into the 'participer' table
		for ($i = 0; $i < $nb_palanque; $i++) {
           DB::insert('INSERT INTO `participer`(`PAL_ID`, `AD_EMAIL`) VALUES (?,?)',[$request->input('nombrePalanques')[$i],$request->input('emails')[$i]]);
        }
		
		
	}
	
}


?>