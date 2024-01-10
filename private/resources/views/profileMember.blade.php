<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Profil</title>

</head>
<body>
  <header>
    <img class = "Logo" src="../img/logo.png" alt="Logo">
    <nav>
      <div class="NavBar">
        <p class="NavText">Plongées anuelle restantes : 90</p>
        <button class = "NavButton">RESERVER SÉANCE</button>
        <button class = "NavButton">PROFIL</button>
        <img id="Logout" src="../img/right-from-bracket-solid.svg" alt="Déconnexion">
      </div>
    </nav>
  </header>
  <i class="fa-solid fa-arrow-left" style="width: 100px; height: 100px; left: 26px; top: 174px; position: absolute"></i>
  <div class="halfBoxContainer">
    <div class="profileBoxes profileHalfbox">
      <p class="profileLabel profileTitles">PROFIL</p>
      <img id="profileImage" src="../img/profile.png" alt="Profil">
    </div>
    <div class="profileBoxes profileHalfbox">
      <p class="profileLabel profileTitles">INFORMATIONS</p>
      <p class="profileName profileText">JORT</p>
      <p class="profileSurname profileText">Fabienne</p>
      <p class="profileLevel profileText">Niveau 3</p>
      <p class="profileRemainingDives profileText">Plongées Restantes : 90</p>
    </div>
  </div>
  <div class="profileBoxes profileFullbox">
    <div class="profileSessionsContainer">
      <div class="profileSessions">
          <p class="profileScheduled profileTitles">SÉANCES PRÉVUES</p>
          <p class="profileText ">19/05/2024 - 9h00 à 12h00</p>
          <p class="profileText ">19/05/2024 - 9h00 à 12h00</p>
          <p class="profileText ">19/05/2024 - 9h00 à 12h00</p>        
      </div>
      <div class="profileSessions">
          <p class="profilePassed profileTitles">SÉANCES PASSÉES</p>
          <p class="profileText ">19/05/2024 - 9h00 à 12h00</p>
          <p class="profileText ">19/05/2024 - 9h00 à 12h00</p>
          <p class="profileText ">19/05/2024 - 9h00 à 12h00</p>        
      </div>
    </div>
    <div class="button profileButton">
      <a href="#">Voir plus</a>
    </div>
  </div>
  

    
</body>
<script src="https://kit.fontawesome.com/1e3d9ff904.js" crossorigin="anonymous"></script>
</html>