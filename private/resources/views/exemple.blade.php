<?php

$tab = array("un","deux","trois");

?>

  <h1> Bonjour </h1>
  
  @foreach($tab as $elt)
  <h2> {{$elt}} </h2>
  @endforeach
  
  <a href="/"> Retour à l'accueil </a>
  