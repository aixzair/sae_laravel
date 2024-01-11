<?php
// app/Http/Controllers/PalanqueController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palanque;
use Illuminate\Support\Facades\Log;


class PalanqueController extends Controller
{
    public function index()
    {
        return view('palanquees');
    }

    public function getPalanqueDetailsForm(Request $request)
    {
		Log::debug("début");
        $request->validate([
            'nb_palanque' => 'required|integer|min:1',
        ]);
		Log::debug("après validate");

        $nb_palanque = $request->input('nb_palanque');
		Log::debug("nb=$nb_palanque");

		if($nb_palanque!=0){
			return view('palanquees', compact('nb_palanque'));
		}
		Log::debug("après if");

		return redirect()->route('palanquees.index');
    }

    public function storePalanqueDetails(Request $request)
    {
		Log::debug("début store");
		
		$nb_palanque = $request->input('nb_palanquee');
		
		$max_idpalanque = Palanque::max('pal_id')+1;
		
        for ($i = 1; $i < $nb_palanque+1; $i++) {
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
		
		

		$request->session()->flash('success_message', 'Les détails de la palanquée ont été enregistrés avec succès.');
		 
		
		
        return redirect()->route('palanquees.index');
    }
	
	public function storeAdherentDetails(Request $request)
	{
		
	}
	
}


?>