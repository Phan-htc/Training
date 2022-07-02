<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="referrer" content="unsafe-url">
    <?php
      $nl = 50;
      $nc = 10;
    ?>
    <title>Génération d'un tableau de <?= "${nc}x${nl}" ?>.</title>
    <style>
     table {
       width:100%;
       background-color:#FFC;
       text-align:center;
       border:solid 1px #000;
       border-collapse:collapse;
     }
 
     td {border:solid 1px #000}
     th {background-color:#CFF}
     tr:nth-child(8n),
     tr:nth-child(8n+1),
     tr:nth-child(8n+2),
     tr:nth-child(8n+3) {background-color:#FCF}
    </style>
  </head>
 
  <body>
    <h1>Voici le tableau</h1>
 
    <table>
      <?php
      $num = 1;
      // création de la ligne en entête
      echo '<tr>';
      for ($c = 0; $c < $nc; $c++) {
	    echo "<th>Col $c</th>\n";
      }
      echo '</tr>';
 
      // création du contenu du tableau
      for ($l = 0; $l < $nl; $l++) { 
	    echo "<tr>\n";
	    for ($c = 0; $c < $nc; $c++) {
	        echo "<td>Cel $num : $l,$c</td>\n";
	        $num++;
	    }
	    echo "</tr>\n";
      }
      ?>
    </table>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>