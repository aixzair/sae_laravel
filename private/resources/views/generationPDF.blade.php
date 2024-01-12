<!-- resources/views/plongee/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
    <title>Résultats des requêtes de plongée</title>
</head>
<body>
    <h1>Fiche de Sécurité</h1>

    <table class="roleTab">
        <tr>
            <th>Date</th>
            <th>Nom Directeur</th>
            <th>Lieu</th>
            <th>Nombre</th>
        </tr>
        @foreach ($tableau1Results as $result)
        <tr>
            <td>{{ $result->plon_date }}</td>
            <td>{{ $result->ad_nom }}</td>
            <td>{{ $result->lieu_nom }}</td>
            <td>{{ $result->count }}</td>
        </tr>
        @endforeach
    </table>

    <table class="roleTab">
        @foreach ($tableau2Results as $result)
        <tr>
            <th>Sécurité</th>
            <th>
                {{ $result->ad_nom }}
            </th>
        </tr>
        @endforeach
        <tr>
            <th>Observation</th>
            <th></th>
        </tr>
    </ul>

    

</body>
</html>
