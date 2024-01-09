<!DOCTYPE html>
<?php
        use Illuminate\Support\Facades\DB;
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    
    <form name="form" action="sessionAdded" method="get">

        <p> Date de la plongée </p>
        <input type="date" name="day-start" min="2018-01-01"/>
        <br>
        <select name="session">
            <?php
                $member = DB::select('SELECT AD_NOM, AD_PRENOM FROM ADHERENT');
                foreach($member as $list){
                    echo '<option>';
                }
            ?>
        </session>
    
        <p> Séance: </p>
        <select name="session">
            <option value="">--Please choose an option--</option>
            <option value="morning">Matin</option>
            <option value="afternoon">Apres-Midi</option>
            <option value="evening">Soir</option>
        </select> <br>

        <button type="submit">Ajouter</button>
    </form>
    ?>
</body>
</html>