<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constitution de palanquées</title>
</head>
<body>
    <h1>Créer les palanquées</h1>
    <?php
        require_once("../../app/Http/Controllers/PalanqueeController.php");
        $controller = new PalanqueeController();

        $controller->generateTable();
    ?>
</body>
</html>