
<?php
    use Illuminate\Support\Facades\DB;

    $result = DB::select("
    SELECT PLON_DATE, CONCAT(PLON_DEBUT, ' à ', PLON_FIN) as creneau, 
        PLON_NIVEAU, LIEU_NOM, PAL_PRONDEUR_MAX, BAT_NOM, 
        CONCAT(ad1.AD_NOM, ' ', ad1.AD_PRENOM) as directeur, 
        CONCAT(ad2.AD_NOM, ' ', ad2.AD_PRENOM) as pilote, 
        CONCAT(ad3.AD_NOM, ' ', ad3.AD_PRENOM) as securite, 
        count(ins.AD_EMAIL) as effectif, PLON_OBSERVATION
        FROM PLONGEE plo 
        JOIN LIEU using (LIEU_ID) 
        JOIN BATEAU using(BAT_ID) 
        JOIN PALANQUE pal USING (PLON_DATE, SEA_ID) 
        JOIN INSCRIRE ins USING (SEA_ID, PLON_DATE) 
        JOIN adherent ad1 ON ad1.AD_EMAIL = PLON_DIRECTEUR 
        JOIN adherent ad2 ON ad2.AD_EMAIL = PLON_PILOTE 
        JOIN adherent ad3 ON ad3.AD_EMAIL = PLON_SECURITE 
        JOIN adherent ad4 ON ad4.AD_EMAIL = ins.ad_email 
        WHERE ad4.AD_EMAIL = '".session('email')."'
        GROUP BY PLON_DATE, creneau, PLON_NIVEAU, LIEU_NOM, PAL_PRONDEUR_MAX,
            BAT_NOM, directeur, pilote, securite, PLON_OBSERVATION;
    ");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <title>Recapitulatif</title>
</head>
<body>
    @include('header');

    <main>
        <table class="roleTab">
        <tr>
                <th>Date</th>
                <th>Créneau</th>
                <th>Niveau</th>
                <th>Site</th>
                <th>Profondeur</th>
                <th>Bateau</th>
                <th>Directeur</th>
                <th>Pilote</th>
                <th>Sécurité</th>
                <th>Effectif</th>
                <th>Observation</th>
            </tr>
            
            @foreach($result as $ligne)
            <tr>
                <th><?php echo $ligne->PLON_DATE ?></th>
                <th><?php echo $ligne->creneau ?></th>
                <th><?php echo $ligne->PLON_NIVEAU ?></th>
                <th><?php echo $ligne->LIEU_NOM ?></th>
                <th><?php echo $ligne->PAL_PRONDEUR_MAX ?></th>
                <th><?php echo $ligne->BAT_NOM ?></th>
                <th><?php echo $ligne->directeur ?></th>
                <th><?php echo $ligne->pilote ?></th>
                <th><?php echo $ligne->securite ?></th>
                <th><?php echo $ligne->effectif ?></th>
                <th><?php echo $ligne->PLON_OBSERVATION ?></th>
            </tr>
            @endforeach

        </table>
    </main>
</body>
</html>