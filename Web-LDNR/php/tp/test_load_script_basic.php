<?php
    //intégrer le script de chargement de classe présent dans l'arborescence du projet sous vendor/autoload.php,
    require_once (__DIR__.'/le_projet/vendor/autoload.php');

    //suite à cette inclusion afficher le chemin de recherche des fichiers,
    //printf('<p>%s</p>\n', htmlspecialchars(get_include_path()));

    //faire le test en créant un objet Symfony\Component\HttpFoundation\Session\Session présent dans Symfony,
    $session = new Symfony\Component\HttpFoundation\Session\Session; 

    $session -> start();

    printf("<p>Le nom de la session est <em>%s</em> et son identifiant et <q>%s</q></p>\n",
    //afficher le nom de la session par la méthode $session->getName().
    $session->getName(), $session->getId());
    //afficher l'identifiant de la session par la méthode $session->getID().






