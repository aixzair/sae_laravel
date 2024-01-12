<script defer src="{{ asset('/js/button.js') }}"></script>
<header>
  <!--  picture of the website-->
  <img class = "Logo" src="{{ asset('/images/logo.png')}}" alt="Logo">

  <nav>
      <div class="NavBar">
        <!-- display the number of remaining dives through at the function that place in the function nbDives that is in the view "Session.php"  -->
      <p class="NavText">Plongées anuelle restantes : {{session('nbDives')}}</p>
      <!--  button that permits to reserve a snorkelling -->
      <button class = "NavButton buttonRoute" data-route="{{route('session/list')}}">RESERVER PLONGÉE</button>
      <!-- button for see the profil of the member currently connect -->
      <button class = "NavButton buttonRoute" data-route="{{route('home')}}">PROFIL</button>
      <!-- button for disconnect, the button use the view deconnexion -->
      <a href="/deconnexion" class="button"><img id="Logout" src="{{ asset('/images/right-from-bracket-solid.svg')}}" alt="Déconnexion"></a>
      </div>
  </nav>
</header>