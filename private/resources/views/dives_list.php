<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dives_list</title>
</head>
<body>
    <?php
        require_once("/../app/Http/Controllers/PlongeeController.php");
        $controller = new PlongeeController();
        if(isset($_GET['dive'])){
            $controller->register('myEmail', $_GET['dive']) //TODO : replace 'myEmail' with the $_SESSION variable
        }
        $controller->displayDivings();
    ?>
</body>
</html>