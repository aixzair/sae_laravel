<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ConnexionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index(){
		
	
		$email=$_POST["email"];
		$password=$_POST["password"];
	
		$max_id= DB::select ('SELECT MAX(RES_ID) AS ID FROM RESPONSABILISER JOIN ADHERENT USING(AD_EMAIL) JOIN RESPONSABILITE USING(RES_ID) WHERE AD_EMAIL=? AND AD_MDP=?',[$email,$password]);
		$num_role= $max_id[0]->ID;
	
		session()->flash('role',$num_role);
		
		if(session('role')===1){
			return view('\exempleSecretaire');
		}
		if(session('role')===2 || session('role')===3|| session('role')===4){
			return view('\welcome');
		}
		if(session('role')===5){
			return view('\exemple');
		}
		if(session('role')===6){
			return view('\exempleResponsable');
		}
		
	}
	
}

?>