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
	
	public function index(Request $request) {
		$email=$request->input('email');
		$password=$request->input('password');
	

		$max_id= DB::select ('SELECT RES_ID AS ID FROM RESPONSABILISER JOIN ADHERENT USING(AD_EMAIL) JOIN RESPONSABILITE USING(RES_ID) WHERE AD_EMAIL=? AND AD_MDP=? order by id desc ',[$email,$password]);
		$count=count($max_id);
		if($count==0){
			session(['role' => 0]);
			session()->flash('email',"");
			session()->flash('password',"");
			return view('\connectionError');
		}
		

		$max_id= DB::select ('SELECT RES_ID AS ID FROM RESPONSABILISER JOIN ADHERENT USING(AD_EMAIL) JOIN RESPONSABILITE USING(RES_ID) WHERE AD_EMAIL=? AND AD_MDP=? order by res_id desc',[$email,$password]);
		$num_role= $max_id[0]->ID;
		session(['role' => $num_role]);
		session()->flash('email',$email);
		session()->flash('password',$password);
		
		if(session('role')===1){
			return redirect()->route('secretary.home');
		} else if(session('role')===2 || session('role')===3|| session('role')===4){
			return redirect()->route('member.home');
		} else if(session('role')===5){
			return redirect()->route('member.home');
		} else if(session('role')===6){
			return redirect()->route('responsable.home');
		}
		
		return redirect()->route('index');
	}
	
}

?>