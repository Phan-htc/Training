<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="referrer" content="unsafe-url"/>
    <title>Remplissage de formulaire tableau indicé</title>
    <style type="text/css">
     h1 {text-align:center;color:#888}
     .error {color:red}
     label {display:block}
     legend {
         background-color:#000;
         color:#FF0;
         border-radius:1ex;
         padding:0.4ex 1ex;
     }
     input[type=text] {
         background-color:#008;
         color:#FFF;
         margin:0.1em;
     }
     input[type=submit] {
         background-color:#800;
         color:#FFF;margin:1em 2em 0;
     }
     fieldset {background-color:#8FF}
    </style>
  </head>
  <body>
    <h1>Affichage de formulaires à partir d'un tableau associatif</h1>
 
    <?php
    $now = date('Y'); 
    $form_array = ['1995-1997' => 'de 95 à 1997',
                   '1998' => 'en 1998',
                   '1999' => 'en 1999',
                   '2000' => "en l'an 2000",
                   '2001' => 'en 2001',
                   '2002' => 'en 2002',
                   '2003' => 'en 2003',
                   '2004-2009' => 'de 2004 à 2009',
                   '2010' => 'en 2010',
                   '2011-'.$now => '≥ 2011 et ≤ '.$now];
 
    print('<form action="#" method="post" novalidate="true">'."\n");
    print("<fieldset><legend>les chiffres d'affaire réalisés</legend>\n");
    foreach($form_array as $key => $val) {
      $def='';
      if(isset($_POST['CA_annuel'][$key])) $def = htmlspecialchars($_POST['CA_annuel'][$key]);
      // via "pattern" le champ ci dessous interdit coté client l'envoi de contenu autre que entier numérique
      // en cas de non correspondance le contenu de champ <samp>title</samp> servira de message d'erreur
      printf('<label><input pattern="\d+" title="valeur numérique entière attendue" type="text" name="CA_annuel[%s]" value="%s"/> : CA(k€) %s</label>'."\n",
             $key, $def, $val);
    }
    echo '<input type="submit" value="Envoyer"/>'."\n";
    echo "</fieldset>\n";
    echo "</form>\n";
    if (isset($_POST['CA_annuel'])) {
      $CA_total = 0;
      echo "<ul>\n";
      foreach ($_POST['CA_annuel'] as $an => $valeur) {
        if (is_numeric($valeur)) {
          printf ("<li><abbr title=\"Chiffre d'affaires\">CA</abbr> de %s : %09.2f K€</li>\n", $an, $valeur);
          $CA_total += $valeur;
        } else if (!empty($valeur)) {
          printf ("<li class=\"error\">Erreur : <strong>%s</strong> ne correspond pas à une valeur numérique (année(s) <strong>%s</strong>)</li>\n",
                  htmlspecialchars($valeur), $an);
        }
      }
      echo "</ul>\n";
      echo "<h4><abbr title=\"Chiffre d'affaires\">CA</abbr> sur la période totale : $CA_total K€</h4>\n";
    }
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>