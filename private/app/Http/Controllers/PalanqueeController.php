<?php

require_once("../../app/Models/PalanqueeModel.php");
class PalanqueeController /*extends Controller*/{

    /**
     * Produce a form for a specified palanquee
     *
     * @param integer $pal_id the planquee's identifier
     * @return void
     */
    public function formulairePalanquee(){
        echo '
            <form method="post">
                <label>Effectif</label>
                <select>
                    <option value=""></option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                </select>
                <label>Profondeur maximum</label>
                <input type="number" name="prof_max" max=70 min=1 />
                <label>Heure de début</label>
                <input type="time" name="heure_debut"></input>
                <label>Heure de fin</label>
                <input type="time" name="heure_fin"></input>
                <button type="submit">Valider</button>
            </form>';

    }

    /**
     * Generate the table which is the main part of the "palanquee" page
     *
     * @return void
     */
    public function generateTable(){
        $model = new PalanqueeModel();
        $divers = $model->getDivers(1, "2024-04-01");
        $palanquees_number = $model->getPalanqueesNumber(1, "2024-04-01");
        $palanquees = $model->getPalanquees(1, "2024-04-01");


        if(isset($_POST['nb_palanquee'])){
            $palanquees_number = $_POST['nb_palanquee'];
            $model->deletePalanquees(1, "2024-04-01");
        }

        for($i = 0; $i < $palanquees_number; $i++){
            $this->formulairePalanquee();
        }

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
            for($i = 1; $i <= $palanquees_number; $i++){
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