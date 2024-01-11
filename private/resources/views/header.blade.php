<header>
  <img class = "Logo" src="../img/logo.png" alt="Logo">
  <nav>
    <div class="NavBar">
    @foreach($resultats as $resultat)
      <p class="NavText">Plongées anuelle restantes : {{ $resultat->total}}</p>
      @endforeach
      <button class = "NavButton">RESERVER SÉANCE</button>
      <button class = "NavButton">PROFIL</button>
      <img id="Logout" src="../img/right-from-bracket-solid.svg" alt="Déconnexion">
    </div>
  </nav>

</header> 



SELECT count(*), ad_email from plongee
join inscrire using (sea_id,plon_date)
join adherent using(ad_email)
where ad_email =  'benjamin.allen@gmail.com'
group by ad_email;*/