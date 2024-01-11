<?php
        use Illuminate\Support\Facades\DB;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- Si il y a eu une tentative d'ajoute, indique la finalité -->
    @if(session('message'))
        <script>alert("{{ session('message') }}");</script>
    @endif

    <form action="{{ route('session/add.submit') }}" method="post">
    @csrf

        <p> Date de la plongée </p>
        <input type="date" name="day-start" min="2018-01-01" required/>
        <br>

        <p> Séance: </p>
        <select name="session" required>
            <option value="">--Sélectionner une période de la journée--</option>
            <option value="morning">Matin</option>
            <option value="afternoon">Apres-Midi</option>
            <option value="evening">Soir</option>
        </select> <br>

        <p> Bateau: </p>
        <select name="boat">
            @foreach($boats as $boat)
                <option>{{$boat->BAT_NOM}}</option>
            @endforeach
        </select>
        <br>

        <p> Directeur<P>
        <select name="director">
            @foreach($directors as $director)
                <option>{{$director->AD_NOM }} {{$director->AD_PRENOM}}</option>
            @endforeach
        </select>

        <p> Sécurité <P>
        <select name="security">
            @foreach($securities as $security)
                <option>{{$security->AD_NOM }} {{$security->AD_PRENOM}}</option>
            @endforeach
        </select>

        <p> Pilote <P>
        <select name="pilot">
            @foreach($pilots as $pilot)
            <option>{{$pilot->AD_NOM }} {{$pilot->AD_PRENOM}}</option>
            @endforeach
        </select>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
