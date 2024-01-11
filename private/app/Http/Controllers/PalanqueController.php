<?php
// app/Http/Controllers/PalanqueController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palanque;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


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
		
		$max_idpalanques = [];
		
		
		
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
		
		

		//$request->session()->flash('success_message', 'Les détails de la palanquée ont été enregistrés avec succès.');
		 
		//$count=DB::select('SELECT COUNT(AD_EMAIL) FROM INSCRIRE WHERE SEA_ID=? AND PLON_DATE=?',[1,'2024-04-01']);
		
		$listeadherents=DB::select('SELECT AD_NOM,AD_PRENOM, AD_EMAIL FROM ADHERENT JOIN INSCRIRE USING (AD_EMAIL) WHERE SEA_ID=? AND PLON_DATE=?',[1,'2024-04-01']);
		
        /*return redirect()->route('palanquees.index')
            ->with('nombreParticipantsInscrits', $count)
            ->with('participantsInscrits', $listeadhérents);*/
		return view('palanquees', ['participantsInscrits' => $listeadherents,'nbPalanque'=>$nb_palanque,'max_idpalanques' => $max_idpalanques]);

    }
	
	public function storeAdherentDetails(Request $request)
	{
		$nb_palanque = $request->input('nb_adherent');
		for ($i = 0; $i < $nb_palanque; $i++) {
           DB::insert('INSERT INTO `participer`(`PAL_ID`, `AD_EMAIL`) VALUES (?,?)',[$request->input('nombrePalanques')[$i],$request->input('emails')[$i]]);
        }
		
		
	}

    public function sessionShow(Request $request) {
        $sea_id = $request->input('SEA_ID');
        $plon_date = $request->input('PLON_DATE');
    
        // Faites ce que vous avez à faire avec les valeurs de $sea_id et $plon_date
    
        // Retournez la vue palanquees.blade.php avec les données nécessaires
        return view('palanquees', ['sea_id' => $sea_id, 'plon_date' => $plon_date]);
    }
    
	
}


?>