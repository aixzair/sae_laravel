<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer séance</title>
    <link rel="stylesheet" href="../css/style.css">
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
  <div>
    <button class="back">
      <i class="fa-solid fa-arrow-left" style="width: 100px; height: 100px; left: 26px; top: 174px; position: absolute"></i>
    </button>
  </div>
  
  <div class="window">
    <div class="labels">
      <p class="label">Date : {{$session['PLON_DATE']}}</p>
      <p class="label">Créneau : {{$session['MOMENT']}}</p>
      <p class="label">Site : {{$session['LIEU_NOM']}} </p>
      <p class="label">Pilote : {{$session['PLON_PILOTE']}}</p>
      <p class="label">Sécurité surf. : {{$session['PLON_SECURITE']}}</p>
      <p class="label">Directeur de plongée : {{$session['PLON_DIRECTEUR']}}</p>
      <p class="label">Bateau : {{$session['BAT_NOM']}}</p>
      <p class="label">Niveau min. :</p>
      <p class="label">Nombre participants : {{$memberCount}}</p>
    </div>
  </div>
</body>
<script src="https://kit.fontawesome.com/1e3d9ff904.js" crossorigin="anonymous"></script>
</html>
