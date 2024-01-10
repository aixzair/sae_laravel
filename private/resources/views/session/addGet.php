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

    $mail_Director = 1;
    $mail_Manager = 1;
    $mail_Driver = 1;
    $num_Bat = 1;
    $periode = 1;

    var_dump($_GET['day-start']);
    var_dump($_GET['director']);
    var_dump($_GET['security']);
    var_dump($_GET['driver']);
    var_dump($_GET['session']);
    var_dump($_GET['boat']);

    $director = explode(" ", $_GET['director']);
    $manager = explode(" ", $_GET['security']);
    $driver = explode(" ", $_GET['driver']);
    $boat = $_GET['boat'];

    switch($_GET['session']){

        case 'Matin': $periode = 1; break;
        case 'Apres-Midi': $periode = 2; break;
        default: $periode = 3; break;
    }

    //$requete = DB::Select('SELECT AD_LICENCE FROM ADHERENT WHERE AD_NOM = :Nom and AD_PRENOM = :Prenom', ['Nom' => 'Martin', 'Prenom' => 'Evelyn']);
    $requete = DB::Select('SELECT * FROM ADHERENT WHERE AD_NOM = :Nom and AD_PRENOM = :Prenom', ['Nom' => $director[0], 'Prenom' => $director[1]]);
    foreach($requete as $member){
        $mail_Director = $member->AD_EMAIL;
    }

    $requete = DB::Select('SELECT * FROM ADHERENT WHERE AD_NOM = :Nom and AD_PRENOM = :Prenom', ['Nom' => $manager[0], 'Prenom' => $manager[1]]);
    foreach($requete as $member){
        $mail_Manager = $member->AD_EMAIL;
    }

    $requete = DB::Select('SELECT * FROM ADHERENT WHERE AD_NOM = :Nom and AD_PRENOM = :Prenom', ['Nom' => $driver[0], 'Prenom' => $driver[1]]);
    foreach($requete as $member){
        $mail_Driver =  $member->AD_EMAIL;
    }

    $requete = DB::Select('SELECT * FROM BATEAU WHERE BAT_NOM = :Nom', ['Nom' => $num_Bat]);
    foreach($requete as $member){
        $mail_Bat =  $member->BAT_ID;
    }


    $requete = DB::insert('INSERT INTO PLONGEE 
    (SEA_ID, PLON_DATE, PLON_DIRECTEUR, BAT_ID, LIEU_ID, PLON_SECURITE, PLON_PILOTE) 
    VALUES (?,?,?,?,?,?,?)', 
    [$periode, $_GET['day-start'], $mail_Director, $num_Bat,1, $mail_Manager, $mail_Driver]);    
    ?>
</body>
</html>