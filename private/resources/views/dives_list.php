<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dives_list</title>
</head>
<body>
    <h1>Séances disponibles</h1>
    <?php
        require_once("../../app/Http/Controllers/PlongeeController.php");
        $controller = new PlongeeController();
        if(isset($_GET['action'])){
            if($_GET['action']=='register'){
                $controller->register($_GET['sea_id'], $_GET['plon_date'], 'abigail.garcia@gmail.com'); //TODO : replace the email address
            }else{
                $controller->deregister($_GET['sea_id'], $_GET['plon_date'], 'abigail.garcia@gmail.com'); //TODO : replace the email address
            }
            
        }
        $controller->displayDivings();
    ?>
</body>
</html>