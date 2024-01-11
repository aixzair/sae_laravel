<!-- resources/views/palanques/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Palanque</title>
</head>
<body>

    <form action="{{ route('get.palanque.details.form') }}" method="post">
    @csrf

    <label for="nb_palanque">Nombre de palanques :</label>
    <input type="number" name="nb_palanque" id="nb_palanque" required>

    <button type="submit">Valider</button>
</form>

@if (isset($nb_palanque))
    <form action="{{ route('store.palanque.details') }}" method="post">
        @csrf
		<input type="hidden" name="nb_palanquee" value="{{$nb_palanque}}">
        @for ($i = 1; $i <= $nb_palanque; $i++)
            <h2>Palanquée {{ $i }}</h2>
            <label for="effectif[{{ $i }}]">Effectif :</label>
            <input type="number" name="effectif[{{ $i }}]" required>

            <label for="heure_min[{{ $i }}]">Heure min :</label>
            <input type="time" name="heure_min[{{ $i }}]" required>

            <label for="heure_max[{{ $i }}]">Heure max :</label>
            <input type="time" name="heure_max[{{ $i }}]" required>

            <label for="profondeur[{{ $i }}]">Profondeur :</label>
            <input type="number" name="profondeur[{{ $i }}]" step="0.01" required>
        @endfor

        <button type="submit">Enregistrer</button>
    </form>
@endif

@if (session('success_message'))
    <div class="alert alert-success">
        
		<form action="{{ route('store.adherent.details') }}" method="post">
        @csrf
		
        @endfor

        <button type="submit">Enregistrer</button>
    </form>
		
    </div>
@endif
	

</body>
</html>
