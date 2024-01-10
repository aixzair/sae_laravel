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
        $model = new PlongeeModel();
        $divings = $model->list();
        echo"<table>";
        while ($session = $divings->fetch()){ 
            /*if($model->isComplete($session['sea_id'], $session['plon_date'])){
                echo '
                    <tr>
                    <td> ' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . '<td/>
                    <tr/>';
            }else{
                if($model->isRegistered($session['sea_id'], $session['plon_date'], "abigail.garcia@gmail.com")){ //TODO replace the email address
                    echo '
                    <tr>
                        <td> <a href="dives_list.php?action=deregister&sea_id=' . $session['sea_id'] . '&plon_date='. $session['plon_date'] .'">Se retirer<a/>' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . '<td/>
                    <tr/>';
                } else{
                    echo '
                    <tr>
                        <td> <a href="dives_list.php?action=register&sea_id=' . $session['sea_id'] . '&plon_date='. $session['plon_date'] .'">Choisir<a/>' . $session['plon_date'] . " - " . $session['plon_debut'] .' à ' . $session['plon_fin'] . '<td/>
                    <tr/>';
                }
                
            }*/

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

    /**
     * Undocumented function
     *
     * @param integer $sea_id the dive's session id
     * @param String $plon_date $plon_date the dive's date
     * @param String $user_email $user_email the user's email 
     * @return void
     */
    public function deregister(int $sea_id, String $plon_date, String $user_email){
        $modele = new PlongeeModel();
        $modele->deregister($sea_id, $plon_date, $user_email);
    }
}

?>