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
	
	// Function to handle login/authentication
	public function index(Request $request) {

		// Retrieve email and password from the request
		$email=$request->input('email');
		$password=$request->input('password');
	
		// Query the database to get the maximum responsibility ID based on the provided email and password
		$max_id= DB::select ('SELECT RES_ID AS ID FROM RESPONSABILISER JOIN ADHERENT USING(AD_EMAIL) JOIN RESPONSABILITE USING(RES_ID) WHERE AD_EMAIL=? AND AD_MDP=? order by id desc ',[$email,$password]);
		
		// Count the number of records returned
		$count=count($max_id);
		
		// If no records are found, set session variables accordingly and redirect to an error view
		if($count==0){
			session(['role' => 0]);
			session(['email' => ""]);
			session()->flash('password',"");
			return view('connectionError');
		}
		

		//$max_id= DB::select ('SELECT RES_ID AS ID FROM RESPONSABILISER JOIN ADHERENT USING(AD_EMAIL) JOIN RESPONSABILITE USING(RES_ID) WHERE AD_EMAIL=? AND AD_MDP=? order by res_id desc',[$email,$password]);
		
		// Retrieve the responsibility ID from the result
		$num_role= $max_id[0]->ID;

		 // Set session variables for role, email, and password
		session(['role' => $num_role]);
		session(['email' => $email]);
		session()->flash('password',$password);
		

		// Redirect based on the user's role
		if(session('role')===1){
			return redirect()->route('secretary.home');
		} else if(session('role')===2 || session('role')===3|| session('role')===4){
			return redirect()->route('member.home');
		} else if(session('role')===5){
			return redirect()->route('director.home');
		} else if(session('role')===6){
			return redirect()->route('responsable.home');
		}
		
		// If no specific role is matched, redirect to the default route
		return redirect()->route('index');
	}
	
}

?>