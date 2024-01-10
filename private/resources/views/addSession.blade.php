<?php
        use App\Model\Member;
        use Illuminate\Support\Facades\DB;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Créer Séance</title>
</head>
<body>
  <header>
    <img class = "Logo" src="{{ asset('/images/logo.png')}}" alt="Logo">
    <nav>
      <div class="NavBar">
        <p class="NavText">Plongées annuelles restantes : 90</p>
        <button class = "NavButton">RESERVER SÉANCE</button>
        <button class = "NavButton">PROFIL</button>
        <img id="Logout" src="{{ asset('images/right-from-bracket-solid.svg') }}" alt="Déconnexion">
      </div>
    </nav>
  </header>
    <?php
        $idDire = 1;
        $idMana = 1;
        $idDriv = 1;
    ?>
    <form class="addSessionForm" name="form" action="sessionAdded" method="get">
        <div class="addSessionLine">
            <p> Date de la plongée </p>
            <input type="date" name="day-start" min="2018-01-01" required/>
        </div>
        <div class="addSessionLine">
            <p> Séance: </p>
            <select name="session" required>
                <option value="">--Sélectionner une période de la journée--</option>
                <option value="morning">Matin</option>
                <option value="afternoon">Apres-Midi</option>
                <option value="evening">Soir</option>
            </select> <br>
        </div>
        <div class="addSessionLine">
            <p> Bateau: </p>
            <select name="boat">
                <?php
                    $bateaux = DB::Select('SELECT * FROM BATEAU');
                    foreach($bateaux as $list){
                        echo '<option> '.$list->BAT_NOM.'</option>';
                    }
                ?>
            </select> <br>
        </div>
        <div class="addSessionLine">
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
        </div>
        <div class="addSessionLine">
            <p> Responsable <P>
            <select name="manager">
                <?php
                    $member = DB::Select('SELECT * FROM ADHERENT');
                    foreach($member as $list){
                        echo '<option> '.$list->AD_NOM.' '.$list->AD_PRENOM.'</option>';
                    }
                ?>
            </select>
        </div>  
        <div class="addSessionLine">  
            <p> Pilote <P>
            <select name="driver">
                <?php
                    $member = DB::Select('SELECT * FROM ADHERENT');
                    foreach($member as $list){
                        echo '<option> '.$list->AD_NOM.' '.$list->AD_PRENOM.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="addSessionLine">
            <button type="submit">Ajouter</button>
        </div>    
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