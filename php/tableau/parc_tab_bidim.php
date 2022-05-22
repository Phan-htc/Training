<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="referrer" content="unsafe-url"/>
    <title>Programmation Web avec PHP : Tableaux multidimensionnels</title>
    <style type="text/css">
     em {
         color:#007;
         font-weight:bold;
     }
     cite {
         color:#FFF;
         background-color:#888;
         padding:0 1em;
         font-weight:bold;
     }
    </style>
  </head>
  <body>
    <h1>tableau multidimensionnel</h1>
    <?php
 
    $bidim_array = [
      ["nom"=>"Émile",
       "profession"=>"super héro",
       "âge"=>30,
       "spécialité"=>"vision sous forme de rayons X" ],
      ["nom"=>"Julien",
       "profession"=>"super héro",
       "âge"=>24,
       "spécialité"=>"force surnaturelle" ],
      ["nom"=>"Raoul",
       "profession"=>"voyou espiègle",
       "âge"=>63,
       "spécialité"=>"technologie microscopique" ],
      ["nom"=>"Alexandre",
       "profession"=>"écolier",
       "âge"=>10,
       "spécialité"=>"technologie microscopique" ],
      ["nom"=>"Hugues",
       "profession"=>"retraité",
       "âge"=>63,
       "spécialité"=>"mot croisés" ],
      ["nom"=>"Roger",
       "profession"=>"Viticulteur",
       "âge"=>63,
       "spécialité"=>"cabernet-sauvignon"],
    ];
 
    print ("<ul>\n");
    foreach($bidim_array as $mkey => $simple_array) {
      printf("<li>élément <em>%d</em> :<ul>\n", $mkey);
 
      for(reset($simple_array);$key = key($simple_array);next($simple_array)) {
        $val = $simple_array[$key];
        printf("<li>clef : <cite>%s</cite>, valeur : <em>%s</em></li>\n", $key, $val);
      }
      print ("</ul></li>\n");
    }
    print ("</ul>\n");
    ?>
    <p>page validée par <a href="http://validator.w3.org/check?uri=referer">validator.w3.org</a></p>
  </body>
</html>