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
        $sel = ' <select> 
                        <option value=""></option>
                        <option value=1>1</option>
                        <option value=2>2</option>
                    <select/> ';
        $palanquees_number = $model->getPalanqueesNumber(1, "2024-04-01");

        echo '<form method="post">';
        echo "<table>
                    <tr>
                    <td> Adhérents <td/>
                    <td> Palanquées <td/>
                    <tr/>";
        foreach($divers  as $person){
            //$sel += "<p>test</p>";
            echo '
                    <tr>
                    <td> '. $person['ad_prenom'] .' ' . $person['ad_nom'] . ' N' . $person['ad_niveau'] . '<td/>
                    <td>
                    <select>
                        <option value=""></option>';
            for($i = 0; $i < $palanquees_number; $i++){
                echo "<option value=$i>$i</option>";
            }

            echo ' 
                </select>
                <td/>
                <tr/>';
        }
        echo "</table>";
        echo "</form>";
    }
} 

?>