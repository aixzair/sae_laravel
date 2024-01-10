<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css" />
    <title>Connexion</title>
</head>
<body>
  <header>
    <img class = "Logo" src="../img/logo.png" alt="Logo">
    <nav>
      <div class="NavBar">
        <p class="NavText">Plongées anuelle restantes : 90</p>
        <button class = "NavButton">RESERVER SÉANCE</button>
        <button class = "NavButton">PROFIL</button>
      </div>
    </nav>
  </header>
  
  <main>
    <div class="connection">
        <div class="connect-p1">
            <h3>Connexion</h3>
        </div>
        <div class="connect-p2">
            <form action="gestionAuthentification" method="post">
			@csrf
                <div>
                    <label for="email">Adresse Email :</label>
                    <input type="email" name="email" id="email" placeholder="email@example.com"><br>
                </div>
                <div>
                    <label for="password">Mot de Passe :</label>
                    <input type="password" name="password" id="password" placeholder="Password">
                </div>
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
