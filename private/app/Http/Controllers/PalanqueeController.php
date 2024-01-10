<?php

require_once("../../app/Models/PalanqueeModel.php");
class PalanqueeController /*extends Controller*/{

    /**
     * Generate the table which is the main part of the "palanquee" page
     *
     * @return void
     */
    public function generateTable(){
        $model = new PalanqueeModel();
        $divers = $model->getDivers(1, "2024-04-01");
        echo "<table>
                    <tr>
                    <td> Adhérents <td/>
                    <td> Palanquées <td/>
                    <tr/>";
        foreach($divers  as $person){
            echo '
                    <tr>
                    <td> '. $person['ad_prenom'] .' ' . $person['ad_nom'] . ' N' . $person['ad_niveau'] . '<td/>
                    <tr/>';
        }
        echo "<table/>";
    }
} 

?>