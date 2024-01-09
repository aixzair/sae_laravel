<?php

require_once("/../app/Models/PlongeeModel.php");
require_once("/../app/Http/Controllers/Controller.php");

class PlongeeController extends Controller
{

    public function __construct(){
        
    }

    /**
     * Displays the dives avaible
     * @return void
     */
    public function displayDivings(){
        $modele = new PlongeeModel();
        $divings = $modele->lister();
        var_dump($divings);
        echo"<form>"
        echo"<table>";
        while ($session = $divings->fetch()){ 
            echo '
                    <tr>
                        <td> <a href\"index.php?page=dives_list&sea_id=' . $session['sea_id'] . '&plon_date='. $session['plon_date'] .'>' . $session['plon_date'] . "-" . $session['lieu_nom'] .'<td/>
                    <tr/>';
        }
        echo"</table>";
        echo"</form>"

    }

    public function register(int $sea_id, String $user_email){
        $modele = new PlongeeModel();
        $modele->register($sea_id, $user_email);
    }
}

/*$controller = new PlongeeController();
$controller->displayDivings();*/

?>