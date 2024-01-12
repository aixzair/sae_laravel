<!-- resources/views/palanques/index.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire Palanque</title>
</head>
<body>

<!-- Check if the number of dives is not set -->
@if (!isset($nb_palanque))
    <!-- Form to get the number of dives -->
    <form action="{{ route('get.palanque.details.form') }}" method="post">        
     @csrf
    <input type="hidden" name="sea_id" value="{{$sea_id}}">
    <input type="hidden" name="plon_date" value="{{$plon_date}}">
    <label for="nb_palanque">Nombre de palanquée :</label>
    <input type="number" name="nb_palanque" id="nb_palanque" required>

    <button type="submit">Valider</button>
	</form>
@endif



<!-- Check if the number of dives is set -->
@if (isset($nb_palanque))
    <!-- Form to store details of dives -->
    <form action="{{ route('store.palanque.details') }}" method="post">
        @csrf
		<input type="hidden" name="nb_palanquee" value="{{$nb_palanque}}">
        <input type="hidden" name="sea_id" value="{{$sea_id}}">
        <input type="hidden" name="plon_date" value="{{$plon_date}}">
        <!-- Loop for all details of a number of dives -->
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


<!-- Check if participantsInscrits is set -->
@if (isset($participantsInscrits))
    <!-- Form to store details of registered members -->
    <form action="{{ route('store.adherent.details') }}" method="post">
        @csrf
		<input type="hidden" name="nb_adherent" value="{{count($participantsInscrits)}}">
		<input type="hidden" name="sea_id" value="{{$sea_id}}">
        <input type="hidden" name="plon_date" value="{{$plon_date}}">
        <!-- Foreach loop for each registered member -->
		@foreach ($max_idpalanques as $key => $max_idpalanque)
            <input type="hidden" name="max_idpalanques[{{ $key }}]" value="{{ $max_idpalanque }}">
        @endforeach
		
        <!-- Loop for each registered member -->
       @for ($i = 0; $i < count($participantsInscrits); $i++)
			<h2>Adhérent</h2>
			<p>Nom: {{ $participantsInscrits[$i]->AD_NOM }}</p>
			<p>Prénom: {{ $participantsInscrits[$i]->AD_PRENOM }}</p>

			<!-- Add a pre-filled input for email -->
			<label for="email_{{ $participantsInscrits[$i]->AD_EMAIL }}">E-mail :</label>
			<input type="hidden" name="emails[{{$i}}]" id="email_{{ $participantsInscrits[$i]->AD_EMAIL }}" value="{{ $participantsInscrits[$i]->AD_EMAIL }}" readonly>
		
			<select name="nombrePalanques[{{$i}}]" id="nombrePalanques">
                <!-- Foreach loop for each possible dive -->
				@foreach ($max_idpalanques as $key => $max_idpalanque)
					<option value="{{$max_idpalanque}}">{{ $max_idpalanque }} palanquée{{ $max_idpalanque > 1 ? 's' : '' }}</option>
				@endforeach
			</select>
		@endfor


        <button type="submit">Enregistrer</button>
    </form>
@endif

<!-- Check if participantsInscrits is set -->
@if (isset($creation))
<form action="{{ route('pdf') }}" method="post">        
     @csrf
    <input type="hidden" name="sea_id" value="{{$sea_id}}">
    <input type="hidden" name="plon_date" value="{{$plon_date}}">

    <button type="submit">Enregistrer pdf</button>
	</form>
 @endif
</body>
</html>
