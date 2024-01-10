<?php
        use Illuminate\Support\Facades\DB;
        use Carbon\Carbon;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <?php
        $id1 = $_GET['id1'];
        $id2 = $_GET['id2'];
        
        //$dt = new Date($id2);
        $dt = (string) $id2;
        echo $dt;

        //$info = DB::Select('SELECT * FROM PLONGEE WHERE PLON_DATE = DATE_FORMAT(\'2024-04-05\', \'%Y/%m/%d\')');
        $info = DB::select('SELECT * FROM PLONGEE WHERE PLON_DATE = ?', ['$dt']);
        foreach($info as $session){
            $date = $session->PLON_DATE;
            $seance = $session->SEA_ID;

            echo $session->PLON_DATE.'<br>';
        }
    ?>


<form name="form" action="sessionEdited" method="get">

<p> Date de la plongée </p>
<input type="date" name="day-start" min="2018-01-01" value=<?php echo $id2 ?> required/>
<br>

<p> Séance: </p>
<select name="session" required>
    <option value="default"><?php echo $id1
    ; ?></option>
    <option value="morning">Matin</option>
    <option value="afternoon">Apres-Midi</option>
    <option value="evening">Soir</option>
</select> <br>

    <input type='hidden' name='id1' value=<?php echo $id1 ?> />
    <input type='hidden' name='id2' value=<?php echo $id2 ?> />

    <button type="submit">Modifier</button>
</form>
</body>
</html>