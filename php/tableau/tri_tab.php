<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>les tableaux : Tri de tableaux</title>
    <style type="text/css">
     .error {color:red}
    </style>
  </head>
 
  <body>
    <h1>Tri de tableaux</h1>
    <h2>Tri de tableau indicé</h2>
    <?php
    $pays = ["us", "ch", "ca", "fr", "de"];
    sort ($pays);
    foreach ($pays as $clef => $val) {
      echo "L'élément <strong>$clef</strong> est égal à <em>$val</em><br/>\n";
    }
    ?>
 
    <h2>Tri de tableau associatif sur les valeurs :</h2>
    <?php
    $pays = [
      'us' => 'États-Unis',
      'ch' => 'Suisse',
      'ca' => 'Canada',
      'fr' => 'France',
      'de' => 'Allemagne',
    ];
    setlocale(LC_ALL, 'fr_FR.UTF-8');  // il faut indiquer comment les chaînes sont représentées et dans quelle langue
    asort ($pays, SORT_LOCALE_STRING); // Tri sur les valeurs en accord avec les locales
    foreach ($pays as $clef => $val) {
      echo "L'élément <strong>$clef</strong> est égal à <em>$val</em><br/>\n";
    }
    ?>
 
    <h2>Tri de tableau associatif sur les clés :</h2>
    <?php
    ksort ($pays); // tri sur les clés
    foreach ($pays as $clef => $val) {
      echo "L'élément <strong>$clef</strong> est égal à <em>$val</em><br/>\n";
    }
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>