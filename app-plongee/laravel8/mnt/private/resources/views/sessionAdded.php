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

    $date = $_GET['day-start'];
     $session = $_GET['session'];

    $requete = DB::insert('INSERT INTO PLONGEE (SEA_ID, PLON_DATE) VALUES (?,?)', [$_GET['session'], $_GET['day-start']]);
        
    ?>
</body>
</html>