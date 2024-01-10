<?php

require_once("../../app/Models/PlongeeModel.php");
//require_once("../../app/Http/Controllers/Controller.php");
/*use app\Models\PlongeeModel as PlongeeModel;
use app\Http\Controllers\Controller as Controller;*/

class PlongeeController /*extends Controller*/
{

    public function __construct(){
        
    }

    /**
     * Displays the dives avaible
     * @return void
     */
    public function displayDivings(){
        $modele = new PlongeeModel();
        $divings = $modele->list();
        echo"<table>";
        while ($session = $divings->fetch()){ 
            if($modele->isComplete($session['sea_id'], $session['plon_date'])){
                echo '
                    <tr>
                    <td> ' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . '<td/>
                    <tr/>';
            }else{
                echo '
                    <tr>
                        <td> <a href="dives_list.php?sea_id=' . $session['sea_id'] . '&plon_date='. $session['plon_date'] .'">' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . '<a/><td/>
                    <tr/>';
            }
        }
        echo"</table>";

    }

    /**
     * register a diver to a dive
     * @param int $sea_id the dive's session id
     * @param String $plon_date the dive's date
     * @param String $user_email the diver's email 
     * @return void
     */
    public function register(int $sea_id, String $plon_date, String $user_email){
        $modele = new PlongeeModel();
        $modele->register($sea_id, $plon_date, $user_email);
    }
}

?>