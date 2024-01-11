<?php
    use App\Http\Controllers\PlongeeController;
    use Illuminate\Support\Facades\DB;

    function getListDivers($sea_id, $plon_date)
    {
        $listDivers = PlongeeController::listDivers($sea_id, $plon_date);
    
        $min =0;
        $max =0;
        $nb=0;
        ?>
        <div class="participantTab">
        <?php
        foreach($listDivers as $line)
        {
            ?>
            <p class="participant">$line->AD_PRENOM $line->AD_NOM $line->NIVEAU</p>;
            <?php
            $max = $line->PLON_EFFECTIFS_MAX;
            $min = $line->PLON_EFFECTIFS_MIN;
            $nb++;
        }
        ?></div><br><br><p class="footer">Min : <?= $min ?> / <?= $nb?> / Max : <?=$max?></p>";
        <?php
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <title>Liste Participants</title>
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
        getListDivers($sea_id, $plon_date);

    ?>
</body>
</html>