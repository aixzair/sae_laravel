<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ajouter plongée</title>

    <link rel="stylesheet" href="{{asset('css/style.css')}}" />

    <script defer src="{{ asset('/js/session.js') }}"></script>
</head>
<body>
    @include('header')

    <!-- Si il y a eu une tentative d'ajoute, indique la finalité -->
    @if(session()->has('message'))
        <script>alert("{{ session('message') }}");</script>
        <?php session()->forget('message'); ?>
    @endif

    <form action="{{ route('session/add.submit') }}" method="post" onsubmit="return check()">
    @csrf

        <p> Date de la plongée </p>
        <input id="addSessionDate" type="date" name="day-start" required/>
        <br>

        <p> Séance: </p>
        <select id="sessionHour" name="session" required>
            <option value="">--Sélectionner une période de la journée--</option>
            <option value="morning">Matin</option>
            <option value="afternoon">Apres-Midi</option>
            <option value="evening">Soir</option>
        </select> <br>

        <p> Effectifs </p>
        <input type="number" id="tentacles" name="effective" min="0" max="3" required/>

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
