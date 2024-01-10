<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css" />
    {# <link rel="stylesheet" href="{{ asset('css/styles.css') }}" /> #}
    <title>Document</title>
</head>
<body>

    <main>

        <h1 class="titleForm">FICHE DE SECURITE</h1>

        <table class="tab">
            <tr>
                <th>Date : </th>
                <th>aze</th>
                <th rowspan="4"><img src="" alt="Logo"></th>
            </tr>
            <tr>
                <th>Directeur de plongée</th>
                <th>aze</th>
            </tr>
            <tr>
                <th>Site de plongée</th>
                <th>aze</th>
            </tr>
            <tr>
                <th>Effectif</th>
                <th>aze</th>
            </tr>
        </table>

        <table class="tab">
            <tr>
                <th colspan="4">PALANQUEE n° ...</th>
            </tr>
            <tr>
                <th>Heure de départ</th>
                <th></th>
                <th>Heure retour</th>
                <th></th>
            </tr>
        </table>

        @foreach()
        <table class="tab">
            <tr>
                <th>Nom Prénom</th>
                <th>Aptitudes</th>
                <th>Fonction</th>
            </tr>
            @foreach()
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @endforeach
        </table>
        @endforeach

    </main>
    
</body>
</html>