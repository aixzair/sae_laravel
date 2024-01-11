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
     * Displays the dives avaible
     * @return void
     */
    public function displayDivings(){
        $model = new PlongeeModel();
        $divings = $model->list();
        echo"<table>";
        while ($session = $divings->fetch()){ 

            if($model->isRegistered($session['sea_id'], $session['plon_date'], "abigail.garcia@gmail.com")){ //TODO replace the email address
                echo '
                    <tr>
                        <td>' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . ' <a href="dives_list.php?action=deregister&sea_id=' . $session['sea_id'] . '&plon_date='. $session['plon_date'] .'">Se retirer<a/><td/>
                    <tr/>'; //Display of the dives where the user in already registered
            }else{
                if($model->isComplete($session['sea_id'], $session['plon_date'])){
                    echo '
                    <tr>
                    <td> ' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . '<td/>
                    <tr/>'; //Display of the dives which already have the maximum amount of participants
                }else{
                    echo '
                    <tr>
                        <td> ' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . ' <a href="dives_list.php?action=register&sea_id=' . $session['sea_id'] . '&plon_date='. $session['plon_date'] .' ">Choisir<a/> .<td/>
                    <tr/>'; //Display of the dives avaible for registration 
                }
            }
        }
        echo"</table>";

    }

    /**
     * Register a diver to a dive
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @return void
     */
    public function register(int $sea_id, String $date){
        $modele = new PlongeeModel();
        $modele->register($sea_id, $date, session('email'));
        return view('sessionList');
    }

    /**
     * Unregister a diver to a dive
     *
     * @param integer $sea_id the dive's session id
     * @param String $plon_date $plon_date the dive's date
     * @return void
     */
    public function unregister(int $sea_id, String $date){
        $modele = new PlongeeModel();
        $modele->unregister($sea_id, $date, session('email'));
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

    /*public function setSessionSubmit(Request $request){
        $data = $request->all();
        $model = new PlongeeModel();

        foreach ($data as $name => $sessions) {
            foreach ($sessions as $value) {
                $values = explode(':', $value);

                if (count($values) < 2) {
                    continue;
                }

                $name = explode(':', $value);
                $areChecked = $model->isRegistered();

                if ($values[1] == "true") {
                    if (!$areChecked) {
                        $model->insertRegisteredSession($values[0], $values[1]);
                    }
                } else {
                    if ($areChecked) {
                        $model->deleteRegisteredSession($values[0], $values[1]);
                    }
                }
            }
        }
    }*/
}

?>