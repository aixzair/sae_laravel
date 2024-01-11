<?php
//use App\Models\sessionListModel;
use app\Http\Controllers\PlongeeController;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../../public/css/style.css" />
  <!--<link rel="stylesheet" href="{{asset('css/style.css')}}" />-->
  <title>Document</title>
</head>
<body>
    <main>
        <div>
            <?php
            $result = DB::Select("
            Select plon_date, plon_debut, plon_fin 
            from PLONGEE 
            join ADHERENT on plon_directeur = ad_email 
            WHERE ad_email = $_SESSION[email]
            ");
            ?>
            @foreach($result as $ligne)
                <div>
                    <a href="">
                        <?php echo $ligne->PLON_DATE." - ". $ligne->PLON_DEBUT." à ".$ligne->PLON_FIN ?>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
</body>
</html>
