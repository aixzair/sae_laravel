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
        //return view('session/list');
        //return redirect('/sessionList');
        return back();
    }

    /**
     * Calls model method to unregister a diver to a dive session
     *
     * @param integer $sea_id the dive's session id
     * @param String $plon_date $plon_date the dive's date
     * @return void
     */
    public function unregister(String $date, int $sea_id){
        $modele = new PlongeeModel();
        $modele->unregister($sea_id, $date, "chloe.young@gmail.com");
        return back();
    }
    /**
     * Calls model method to check is dive session is full
     *
     * @param integer $sea_id
     * @param String $plon_date
     * @return boolean
     */
    public static function isComplete(int $sea_id, String $plon_date){
        $modele = new PlongeeModel();
        return $modele->isComplete($sea_id, $plon_date);
    }

    /**
     * Calls model method to check if user is registered for selectted dive session
     *
     * @param string $sea_id
     * @param string $plon_date
     * @param string $user_email
     * @return boolean
     */
    public static function isRegistered(string $sea_id, string $plon_date, string $user_email){
        $modele = new PlongeeModel();
        return $modele->isRegistered($sea_id, $plon_date, $user_email);
    }

    /**
     * Calls model method to check if the user's diver level is high enough for selected dive session
     *
     * @param string $sea_id
     * @param string $plon_date
     * @param string $user_email
     * @return boolean
     */
    public static function isRightLevel(string $sea_id, string $plon_date, string $user_email){
        $modele = new PlongeeModel();
        return $modele->isRightLevel($sea_id, $plon_date, $user_email);
    }

    /**
     * Calls model method to check if selected session is valid (all attributes filled)
     *
     * @param string $sea_id
     * @param string $plon_date
     * @return boolean
     */
    public static function isValid(string $sea_id, String $plon_date){
        $modele = new PlongeeModel();
        return $modele->isValid($sea_id, $plon_date);
    }

    public static function listDivers(string $sea_id, String $plon_date){
        $modele = new PlongeeModel();
        return $modele->listDivers($sea_id, $plon_date);
    }

}

?>