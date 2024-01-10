<?php
    // Requete php pour recup les adhérents : 
    // $lignes = DB::select("SELECT AD_NOM, AD_PRENOM FROM ADHERENT"); // use .... 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Attribution des rôles</title>

    <script defer src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script defer src="{{ asset('/js/updateRoles.js') }}"></script>
</head>
<body>
    <?php // include "header.blade.php" ?>
    <main>
        <div>
            <button class="back">
                <img src="{{ asset('/images/arrow-left-solid.svg')}}" alt="Retour">
            </button>
        </div>

        <p>{{$message}}</p>

        <form action="{{ route('roles.submit') }}" method="post" onsubmit="updateCheckBox()">
        @csrf
            <table class="roleTab">
                <tr>
                    <th>Adhérents</th>
                    <th>Pilote</th>
                    <th>Sécurité de Surface</th>
                    <th>Directeur de Plongées</th>
                    <th>Plongeur</th>
                </tr>

                @foreach ($names as $name => $responsabilities)
                <tr>
                    <th>{{ $name }}</th>
                    <th>
                        <input
                            class="roleCheck"
                            type="checkbox"
                            name="{{ $name }}[]"
                            value="pilote"
                            {{in_array("pilote", $responsabilities)? 'checked': ''}}
                        >
                    </th>
                    <th>
                        <input
                            class="roleCheck"
                            type="checkbox"
                            name="{{ $name }}[]"
                            value="sécurité"
                            {{in_array("sécurité", $responsabilities)? 'checked': ''}}
                        >
                    </th>
                    <th>
                        <input
                            class="roleCheck"
                            type="checkbox"
                            name="{{ $name }}[]"
                            value="directeur"
                            {{in_array("directeur", $responsabilities)? 'checked': ''}}
                        >
                    </th>
                    <th>
                        <input 
                            class="roleCheck"
                            type="checkbox"
                            name="{{ $name }}[]"
                            value="plongeur"
                            {{in_array("plongeur", $responsabilities)? 'checked': ''}}
                        >
                    </th>
                </tr>
                @endforeach
            </table>

            <button type="submit">Valider</button>
        </form>
    </main>
</body>
</html>