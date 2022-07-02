<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="referrer" content="unsafe-url" />
  <title>Jeu d'échecs</title>
  <style>
    table {
      border: #F88 solid 1ex;
      border-collapse: collapse;
      background-color: #bbb;
    }

    tr:nth-child(even) td:nth-child(odd),
    tr:nth-child(odd) td:nth-child(even) {
      background-color: #666
    }

    /*odd = impaire, even = paire */
    td {
      width: 4rem;
      height: 4rem;
      text-align: center;
      font-size: 3.5rem;
    }
  </style>
</head>

<body>
  <table>
    <?php
    $pieces = explode(' ', '♔ ♕ ♖ ♗ ♘ ♙ ♚ ♛ ♜ ♝ ♞ ♟'); //declare les pièces
    $dispo = [[8, 10, 9, 7, 6, 9, 10, 8], 11, null, null, null, null, 5, [2, 4, 3, 1, 0, 3, 4, 2]]; //indique l'ordre des pieces
    for ($j = 0; $j < 8; $j++) {
      echo "      <tr>";
      for ($i = 0; $i < 8; $i++) {
        // utilisation pertinente de l'opérateur coalescent noté ?? (PHP7+)
        // le "@" permet d'éviter les erreurs de type "accès à valeur indéfinie" apparues en PHP version 7.3
        echo '<td>';
        if (is_array($dispo[$j])) echo $pieces[$dispo[$j][$i]];
        elseif (isset($dispo[$j])) echo $pieces[$dispo[$j]];
        echo '</td>';
      }
      echo "</tr>\n";
    }
    ?>
  </table>
  <p>validé par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
</body>

</html>