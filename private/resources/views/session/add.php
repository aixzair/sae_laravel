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
        $idDire = 1;
        $idMana = 1;
        $idDriv = 1;
    ?>
    <form name="form" action="sessionAdded" method="get">

        <p> Date de la plongée </p>
        <input type="date" name="day-start" min="2018-01-01" required/>
        <br>

        <p> Séance: </p>
        <select name="session" required>
            <option value="">--Sélectionner une période de la journée--</option>
            <option value="morning">Matin</option>
            <option value="afternoon">Apres-Midi</option>
            <option value="evening">Soir</option>
        </select> <br>

        <p> Bateau: </p>
        <select name="boat">
            @foreach($boats as $boat)
                <option>{{$boat->BAT_NOM}}</option>
            @endforeach
        </select>
        <br>

        <p> Directeur<P>
        <select name="director">
            <?php
                $member = DB::Select('SELECT * FROM ADHERENT');
                foreach($member as $list){
                    $idDire = $list->AD_LICENCE;
                    echo '<option> '.$list->AD_NOM.' '.$list->AD_PRENOM.'</option>';
                }
            ?>
        </select>
        <p> Responsable <P>
        <select name="manager">
            <?php
                $member = DB::Select('SELECT * FROM ADHERENT');
                foreach($member as $list){
                    echo '<option> '.$list->AD_NOM.' '.$list->AD_PRENOM.'</option>';
                }
            ?>
        </select>
        <p> Pilote <P>
        <select name="driver">
            <?php
                $member = DB::Select('SELECT * FROM ADHERENT');
                foreach($member as $list){
                    echo '<option> '.$list->AD_NOM.' '.$list->AD_PRENOM.'</option>';
                }
            ?>
        </select>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

<?php
    /*
@foreach($members as $member)
            @if($member instanceof Member)
                <p>{{$member->$AD_NOM}}
                {{$member->$AD_PRENOM}}</p>
            @endif
        @endforeach
*/
?>