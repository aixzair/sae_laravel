<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <title>Profil</title>
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
        <button class="button profileButton buttonRoute" data-route="{{route('session/director')}}">Liste de mes Séances</button>
      </div>
    </div>

    <div class="profileBoxes profileFullbox tabSession">
      <h1 class="titre" id="infoSeance">Info Plongées</h1>
             
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
        
        </table>
        <div class="button profileButton buttonRoute" data-route="{{route('showMore.home')}}">Voir plus</div>
    </div>
  </main>
</body>

</html>