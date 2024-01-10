<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>dives_list</title>
</head>
<body>
    <?php
        require_once("../../app/Http/Controllers/PlongeeController.php");
        $controller = new PlongeeController();
        if(isset($_GET['dive'])){
            $controller->register($_GET['sea_id'], $_GET['plon_date'], 'myEmail'); //TODO : replace 'myEmail' with the $_SESSION variable
        }
        $controller->displayDivings();
    ?>
</body>
</html>