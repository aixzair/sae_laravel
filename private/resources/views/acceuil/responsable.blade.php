<?php
  use Illuminate\Support\Facades\DB;

  $lignes = DB::select("SELECT AD_NOM, AD_PRENOM, AD_NIVEAU, PLON_DATE FROM ADHERENT JOIN INSCRIRE USING (AD_EMAIL) JOIN PLONGEE USING (SEA_ID, PLON_DATE) LIMIT 3"); 
  // use ...
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <title>Profile</title>

  <script defer src="{{ asset('/js/button.js') }}"></script>
</head>
<body>

  @include('header')

  <main>
    <div class="halfBoxContainer">
      <div class="profileBoxes profileHalfbox">
        <p class="profileLabel profileTitles">INFORMATIONS</p>
        <p class="profileName profileText">JORT</p>
        <p class="profileSurname profileText">Fabienne</p>
        <p class="profileLevel profileText">Niveau 3</p>
        <p class="profileRemainingDives profileText">Plongées Restantes : 90</p>
      </div>

      <div class="profileBoxes profileHalfbox container">
        <button id="buttonRolesSet" class="button profileButton" data-route="{{ route('role.set') }}">ATTRIBUTION DES RÔLES</button>
        <button class="button profileButton">ARCHIVES DES FICHES DE SÉCURITÉ</button>
        <button class="button profileButton">CRÉER SÉANCE</button>
      </div>
    </div>

    <div class="profileBoxes profileFullbox tabSession">
      <h1 class="titre" id="infoSeance">Info Séance</h1>
        <table class="roleTab">
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Niveau</th>
            <th>Séance</th>
          </tr>
          
        <!-- Un for each pour recup les 3 premier résultat pour les adhérents ayant participé à une plongée passée -->
          
          <?php foreach($lignes as $ligne){ ?>
          <tr>
            <th><?php echo" $ligne->AD_NOM"?></th>
            <th><?php echo" $ligne->AD_PRENOM"?></th>
            <th><?php echo" $ligne->AD_NIVEAU"?></th>
            <th><?php echo" $ligne->PLON_DATE"?></th>
          </tr>
          <?php } ?> 
        
        </table>
      <div class="button profileButton">
        <a href="#">Voir plus</a>
      </div>
    </div>
  </main>
</body>

</html>