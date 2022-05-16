<?php 
@include('mes_parametre.php');

header('Content-Type: text/html; charset=utf-8');

if (isset($var)) {
    echo "<h2>Bonjour ".$var."</h2>\n";
  } else {
    echo "<h2>Il n'y a personne à qui dire Bonjour.</h2>\n";
  }
  echo "<p>Le chemin d'inclusion courant est <samp>".
        get_include_path()."</samp></p>\n";