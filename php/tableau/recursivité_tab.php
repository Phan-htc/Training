<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>parcours de Tableaux multidimensionnels par la récursivité</title>
    <style type="text/css">
     em {
         color:#007;
         font-weight:bold;
     }
    </style>
  </head>
  <body>
    <h1>tableau multidimensionnel</h1>
    <?php
    $multi_array = ['condiments' => ['sel' => ['de Guérande', 'extra-fin', 'Gemme'],
                                     'poivre' => ['noir', 'gris'],
                                     'huile'  => ["d'olive", "d'arachide"],
                                     'vinaigre' => ['de vin', 'balsamique'],
                                     'moutarde',
                                     'piment',
                                     'autres'],
                    'prénoms' => ['composés' => explode(' ', 'Jean-Luc Jean-Louis Marc-Antoine Marie-Rose Louis-Philippe'),
                                  'simples'  => explode(' ', 'Émile Julie Huguette Henri Paule')],
 
                    [
                      ['politesse' => [explode(' ', 'Bonjour Merci'),
                                       explode('-', 'À-demain'),
                                       explode('-', 'Au-Revoir')]
                      ]
                    ]
    ];
 
    function parcours_tableau($val, $depth=0) {
      if (is_array($val)) {
        $whsp = str_repeat(' ', $depth*4); // pour indenter correctement le HTML
        echo "<ul>\n";
        foreach ($val as $skey => $sval) {
          printf("%s    <li><em>%s</em> ", $whsp, $skey);
          if (is_array($sval)) {
            parcours_tableau($sval, $depth+1);
          } else {
            echo $sval;
          }
          echo "</li>\n";
        }
        echo $whsp."</ul>";
      } else {
        printf('<h3 class="error">%s ne correspond pas à un tableau</h3>'."\n", $val);
      }
    }
 
    parcours_tableau($multi_array);
    ?>
  </body>
</html>