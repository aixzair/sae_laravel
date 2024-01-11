<?php

namespace App\Http\Controllers;

use App\Models\PlongeeModel;
use App\Http\Controllers\Controller as Controller;
//use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;

class PlongeeController extends Controller
{

    public function __construct(){
        
    }

    /**
     * Register a diver to a dive
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @return void
     */
    public function register(String $date, int $sea_id){
        $modele = new PlongeeModel();
        $modele->register($sea_id, $date, "chloe.young@gmail.com");
        return view('sessionList');
    }

    /**
     * Unregister a diver to a dive
     *
     * @param integer $sea_id the dive's session id
     * @param String $plon_date $plon_date the dive's date
     * @return void
     */
    public function unregister(String $date, int $sea_id){
        $modele = new PlongeeModel();
        $modele->unregister($sea_id, $date, "chloe.young@gmail.com");
        return view('sessionList');
    }

    public static function isComplete(int $sea_id, String $plon_date){
        $modele = new PlongeeModel();
        return $modele->isComplete($sea_id, $plon_date);
    }

    public static function isRegistered(int $sea_id, String $plon_date, String $user_email){
        $modele = new PlongeeModel();
        return $modele->isRegistered($sea_id, $plon_date, $user_email);
    }

    public static function isValid(int $sea_id, String $plon_date){
        $modele = new PlongeeModel();
        return $modele->isValid($sea_id, $plon_date);
    }

}

?>