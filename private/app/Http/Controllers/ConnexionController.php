<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ConnexionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public function index(Request $request){
		
	
		$email=$request->input('email');
		$password=$request->input('password');
	
		$max_id= DB::select ('SELECT RES_ID AS ID FROM RESPONSABILISER JOIN ADHERENT USING(AD_EMAIL) JOIN RESPONSABILITE USING(RES_ID) WHERE AD_EMAIL=? AND AD_MDP=? order by id desc ',[$email,$password]);
		$count=count($max_id);
		if($count==0){
			session()->flash('role',0);
			return view('\connectionError');
		}
		
		$num_role= $max_id[0]->ID;
	
		session()->flash('role',$num_role);
		
		if(session('role')===1){
			return view('\profileSecretary');
		}
		if(session('role')===2 || session('role')===3|| session('role')===4){
			return view('\profileMember');
		}
		if(session('role')===5){
			return view('\profileMember');
		}
		if(session('role')===6){
			return view('\profilResp');
		}
		
	}
	
}

?>