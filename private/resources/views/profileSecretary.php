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

  <?php include 'header.blade.php' ?> 

  <div>
    <button class="back">
      <i class="fa-solid fa-arrow-left" style="width: 100px; height: 100px; left: 26px; top: 174px; position: absolute"></i>
    </button>
  </div>
  
    <form action="#">
    @csrf
      <div class="window">
        <div class="labels">
          <label for="name" >Nom :</label>
          <label for="firstname">Prénom :</label>
          <label for="license">Num licence :</label>
          <label for="level">Niveau :</label>
          <label for="dateCert">Date certificat méd. :</label>
          <label >Forfait :</label>
          <label >Rôles :</label>
          <label for="email">Email :</label>
          <label for="password">Mot de passe :</label>
        </div>

        <div class="inputFields">
          <input id="name" type="text">
          <input id="firstname" type="text">
          <input id="licence" type="number">
          <select name="level" id="level">
            <option value="L1">L1</option>
            <option value="L2">L2</option>
            <option value="L3">L3</option>
            <option value="L4">L4</option>
          </select>
          <input id="dateCert" type="date">
          <div class="forfait">
            <div>
              <label for="adultPackage">Adulte</label>
              <input id="adultPackage" type="checkbox">
            </div>
            <div>
              <label for="kidPackage">Enfant</label>
              <input id="kidPackage" type="checkbox">
            </div>      
          </div>

          <div class="forfait">
            <div>
              <label for="pilot">Pilote</label>
              <input id="pilot" type="checkbox">
            </div>
            <div>
              <label for="security">Sécu. Surface</label>
              <input id="security" type="checkbox">
            </div>
            <div>
              <label for="director">Directeur</label>
              <input id="director" type="checkbox">
            </div>
            <div>
              <label for="security">Sécu. Surface</label>
              <input id="security" type="checkbox">
            </div>
          </div>

          <input id="email" type="email">
          <input id="password" type="password">
        </div>
    </div>
    <input id="inscription" type="submit" value="Valider">
  </form>
</body>
</html>