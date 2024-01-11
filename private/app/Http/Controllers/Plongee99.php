<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VotreController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function votreMethode(Request $request)
    {

        $mail = $request->input('mail');

        $resultats = DB::select ('SELECT count(*), ad_email from plonge join inscrire using (sea_id,plon_date) join adherent using(ad_email) where ad_email = ? group by ad_email;', [$mail]);

        return view('header', ['resultats' => $resultats]);
    }
}