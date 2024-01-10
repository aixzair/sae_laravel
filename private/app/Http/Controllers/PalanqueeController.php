<?php

require_once("../../app/Models/PalanqueeModel.php");
class PalanqueeController /*extends Controller*/{
    public function generateTable(){
        $model = new PalanqueeModel();
        $divers = $model->getDivers(1, "2024-04-01");
        foreach($divers  as $person){
            
        }
    }
} 

?>