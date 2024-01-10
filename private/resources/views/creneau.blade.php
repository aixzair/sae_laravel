<?php
        use Illuminate\Support\Facades\DB;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
        <title>Créneau</title>
</head>
<body class="antialiased">

<?php
        $seance = 'MATIN';
        $requete = DB::select("SELECT * FROM PLONGEE");
        echo "séance disponible <br>";
        $i = 1;
        foreach($requete as $line){
            switch($line->SEA_ID){
                case 1: $seance = 'MATIN'; break;
                case 2: $seance = 'APRES_MIDI'; break;
                default: $seance = 'SOIR'; break;
            }
            echo 'séance n°:'.$i.' '.$seance.' '.$line->PLON_DATE.'<br>';
            $i++;
        }
    ?>
</body>
</html>
