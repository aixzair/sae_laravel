<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constitution de palanquées</title>
</head>
<body>
    <h1>Créer les palanquées</h1>
    <form method="post">
        <label>Nombre de palanquées :</label>
        <input type="number" name="nb_palanquee" max=15 min=1 />
        <button type="submit">Valider</button>
    </form>
    <?php
        require_once("../../app/Http/Controllers/PalanqueeController.php");
        $controller = new PalanqueeController();


        if(isset($_POST['nb_palanquee'])){
            
        }

        $controller->generateTable();

        var_dump($_POST);
    ?>
</body>
</html>