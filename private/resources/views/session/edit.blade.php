<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  <title>Séance</title>
</head>
<body>
  <header>
    <img class = "Logo" src="../img/logo.png" alt="Logo">
  </header>
  
  <div class="window">
    <div class="labels">
      <form action="{{ route('session/edit.submit') }}" method="post">
        @csrf
        <p class="label">DATE: </p>
        <input type="date" name="day-start" min="2018-01-01" value= "{{$session['PLON_DATE']}}" required/>

        <p class="label">Créneau:</p>
        <select name="session" required>
              <option value="">{{$session['MOMENT']}}</option>
              <option value="morning">Matin</option>
              <option value="afternoon">Apres-Midi</option>
              <option value="evening">Soir</option>
          </select>

        <p class="label">Site : {{$session['LIEU_NOM']}} </p>

        <p class="label">Pilote :</p>
        <select name="pilot">
              @foreach($pilots as $pilot)
              <option>{{$pilot->AD_NOM }} {{$pilot->AD_PRENOM}}</option>
              @endforeach
          </select>

        <p class="label">Sécurité : </p>
        <select name="security">
            @foreach($securities as $security)
                <option>{{$security->AD_NOM }} {{$security->AD_PRENOM}}</option>
            @endforeach
        </select>

        <p class="label">Directeur : </p>
        <select name="director">
            @foreach($directors as $director)
                <option>{{$director->AD_NOM }} {{$director->AD_PRENOM}}</option>
            @endforeach
        </select>

        <p class="label">Bateau :</p>
        <select name="boat">
            @foreach($boats as $boat)
                <option>{{$boat->BAT_NOM}}</option>
            @endforeach
        </select>

        <p class="label">Niveau min. :</p>

        <input type="text" name="pSession" value="{{$session['SEA_ID']}}">
        <input type="text" name="pDate" value="{{$session['PLON_DATE']}}">

        <button type="submit">Ajouter</button>
      </form>
    </div>
  </div>
</body>
<script src="https://kit.fontawesome.com/1e3d9ff904.js" crossorigin="anonymous"></script>
</html>