<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Set character set and viewport for better rendering on various devices -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Preconnect to Google Fonts for faster loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Import the Roboto font from Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    
    <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="../css/style.css" />
    
    <!-- Set the title of the HTML document -->
    <title>Connexion</title>
</head>
<body>
 <!-- Header section -->
  <header>
    <!-- Display the logo image -->
    <img class = "Logo" src="{{ asset('/images/logo.png')}}" alt="Logo">
  </header>

  <!-- Main content section -->
  <main>
     <!-- Connection form container -->
    <div class="connection">
        <div class="connect-p1">
            <h3>Connexion</h3>
        </div>
        <div class="connect-p2">
            <!-- Form to submit user credentials -->
            <form action="/gestionAuthentification" method="post">
			@csrf <!-- CSRF token for security -->
                <div>
                    <!-- Input field for email address -->
                    <label for="email">Adresse Email :</label>
                    <input type="email" name="email" id="email" placeholder="email@example.com"><br>
                </div>

                <!-- Input field for password -->
                <div class="connectionLine">
                    <label class="connectionLabels" for="password">Mot de Passe :</label>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>

                <!-- Button to submit the form -->
                <div class="btns">
                    <div class="btn-container">
                        <button class="btn" type="submit">Se connecter</button>
                        <br>
                    </div>
                </div>
            </form>
        </div>
    </div>
</main>


</body>
</html>
