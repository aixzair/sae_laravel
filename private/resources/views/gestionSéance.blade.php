<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Gestion de la Plongée</title>
</head>
<body>
    
<?php include "header.blade.php" ?>

    <main>
        <div>
        <label for="teams">Nombre de palanquées : </label>
            <select name="pets" id="pet-select">
            <option value="">Choisissez un nombre</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
        </select>
    <!-- For later when needed
        <button>
            Aléatoire
        </button>
     -->
        </div>

        <div>
            <table class="teamsTab">
                
                <tr>
                    <th>Adhérents</th>
                    <th>Palanquées</th>
                </tr>

                <!-- <?php
                    foreach($lignes as $ligne){
                    echo
                    "<tr>
                        <th>".$ligne["AD_NOM"]." ". $ligne["AD_PRENOM"]."</th>
                        <th><input class=\"roleCheck\" type=\"checkbox\"></th>
                        <th><input class=\"roleCheck\" type=\"checkbox\"></th>
                        <th><input class=\"roleCheck\" type=\"checkbox\"></th>
                        <th><input class=\"roleCheck\" type=\"checkbox\"></th>
                    </tr>";
                    }
                ?> -->
                
            </table>
        </div>

        
    </main>

</body>
</html>