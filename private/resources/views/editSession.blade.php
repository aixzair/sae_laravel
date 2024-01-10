<?php
        use Illuminate\Support\Facades\DB;
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
        $date = 0;
        $dt = new DateTime($id2);
        
        $seance = 1;
        $info = DB::Select('SELECT * FROM PLONGEE WHERE PLON_DATE = '.date ('Y-m-d',$id1).'& SEA_ID= '.$id2);
        foreach($info as $list){
            $date = $list->PLON_DATE;
            $seance = $list->SEA_ID;
        }
    ?>

<form name="form" action="sessionAdded" method="get">

<p> Date de la plongée </p>
<input type="date" name="day-start" min="2018-01-01" value=<?php echo $dt->format('Y-m-d'); ?> required/>
<br>

<p> Séance: </p>
<select name="session" required>
    <option value="default"><?php echo $id1; ?></option>
    <option value="morning">Matin</option>
    <option value="afternoon">Apres-Midi</option>
    <option value="evening">Soir</option>
</select> <br>

    <button type="submit">Modifier</button>
</form>
</body>
</html>