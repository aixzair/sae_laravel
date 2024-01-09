<?php
    // Requete php pour recup les adhérents : 
    // $lignes = DB::select("SELECT AD_NOM, AD_PRENOM FROM ADHERENT"); // use .... 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css" />
    <title>Attribution des rôles</title>
</head>
<body>
    <?php include "header.php" ?>
    <main>
        <div>
            <button class="back">
                <img src="../img/arrow-left-solid.svg" alt="Retour">
            </button>
        </div>

        <table class="roleTab">
            
            <tr>
                <th>Adhérents</th>
                <th>Pilote</th>
                <th>Sécurité de Surface</th>
                <th>Directeur de Plongées</th>
                <th>Plongeur</th>
            </tr>

            <?php
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
            ?>
            
        </table>
    </main>
</body>
</html>