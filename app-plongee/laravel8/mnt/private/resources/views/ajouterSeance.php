<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
     use Illuminate\Http\Request;

     $content = 0;
     Route::post('/upload', function (Request $request) {
         $content = $request->file('photo')->get();
     });

     
     var_dump($content);
        
    ?>
</body>
</html>