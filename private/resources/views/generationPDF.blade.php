<!-- resources/views/plongee/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Résultats des requêtes de plongée</title>
</head>
<body>
    <h1>Résultats des requêtes de plongée</h1>

    <h2>Tableau 1</h2>
    <table border="1">
        <tr>
            <th>Date</th>
            <th>Nom Adhérent</th>
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

    <h2>Tableau 2</h2>
    <ul>
        @foreach ($tableau2Results as $result)
        <li>{{ $result->ad_nom }}</li>
        @endforeach
    </ul>

    <h2>Tableau 3</h2>
    <p>Nombre de palanquées : {{ $tableau3Results }}</p>

</body>
</html>
