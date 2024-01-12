<script defer src="{{ asset('/js/button.js') }}"></script>
<header>
  <img class = "Logo" src="{{ asset('/images/logo.png')}}" alt="Logo">

  <nav>
      <div class="NavBar">
      <p class="NavText">Plongées anuelle restantes : {{session('nbDives')}}</p>
      <button class = "NavButton buttonRoute" data-route="{{route('session/list')}}">RESERVER PLONGÉE</button>
      <button class = "NavButton buttonRoute" data-route="{{route('home')}}">PROFIL</button>
      <a href="/deconnexion" class="button"><img id="Logout" src="{{ asset('/images/right-from-bracket-solid.svg')}}" alt="Déconnexion"></a>
      </div>
  </nav>
</header>
