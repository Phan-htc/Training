---
title: Setup & Teardown
---

Dans certains cas, le test utilise des objets qui doivent être manipulés avant que le test débute, et après qu’il se soit terminé. Ces étapes pouvant nuire à la lisibilité et maintenabilité du code, PHPUnit vous fourni des fonctions à surcharger.

# Setup & teardown

Pour ce test, vous allez tester et corriger une classe implémentant un système de log dans un fichier.

> :warning: Pour ce test, vous avez besoin du paquet `psr/log` installé lors du TP précédent. Si vous ne l’aviez pas installé, vous pouvez le faire maintenant avec la commande suivante :
>
> ```bash
> ./composer.phar require "psr/log"
> ```

Téléchargez et copiez ces deux fichiers dans votre projet :

* [FileLogger.php](FileLogger.php.txt)
* [FileLoggerTest.php](FileLoggerTest.php.txt)

Une fois ces fichiers copiés, lancez les tests unitaires et effectuez les corrections nécessaire pour qu’ils passent.

Pour l’instant, ce test ne contient que deux cas qui fonctionnent de manière similaire ; créer un objet, effectuer le test puis supprimer l’objet et le fichier de log. Pour deux cas, on peut admettre cette répétition mais pour tester d’autres comportements, ça va vite devenir pénible et source d’erreurs.

Il est donc temps de simplifier ce code en le factorisant. Ajouter un attribut protégé à votre classe pour stocker l’objet _logger_ et définissez les fonctions `setUp()` et `tearDown()` pour configurer et nettoyer l’environnement de vos tests. Le code suivant est un squelette que vous pouvez copier et compléter.

```php
protected $logger ;

protected function setUp():void
{
    // TODO
}

protected function tearDown(): void
{
    // TODO
}
```

> :warning: Même si l’indication de type de retour `:void` en fin de ligne est habituellement facultative lorsque vous déclarez vos propres fonctions, elle est ici nécessaire car vos fonctions surchargent la version définie dans la classe _TestCase_ de PHPUnit qui utilise ce typage. Si vous ne l’écriviez pas, l’exécution de PHPUnit s’arrêterait sur une erreur (vos fonctions seraient incompatibles).

Modifiez ensuite les deux cas de tests pour supprimer le code redondant et adaptez-les pour utiliser votre logger (qui est maintenant un attribut et plus une simple variable locale).

Ajoutez un nouveau cas de test pour vérifier que deux appels successifs aux fonctions de logs vont bien ajouter deux lignes au fichier. Corrigez l’implémentation si nécessaire (dans ce cas, la [documentation de file_put_contents()](https://www.php.net/manual/fr/function.file-put-contents.php) peut vous être utile).

# Markdown online

Contrairement au cas précédent où les fonctions d’installation et nettoyage doivent avoir lieu avant et après chaque test, on a parfois besoin que ces actions ne soient fait qu’une fois avant et après tous les tests (et pas individuellement).

Pour vous l’illustrer, nous allons tester (et vérifier) l’implémentation d’un convertisseur html/markdown utilisant l’API web de pandoc.

Téléchargez et copier les deux fichiers suivants dans votre projet :

* [MarkdownOnline.php](MarkdownOnline.php.txt)
* [MarkdownOnlineTest.php](MarkdownOnlineTest.php.txt)

Lancez les tests unitaire et effectuez les corrections nécessaires pour qu’ils passent.

Observez maintenant le code source de la classe et de son test :

1. La classe crée un descripteur de ressource de CURL pour effectuer la requête vers le serveur de pandoc,
1. Le cas de test commence par créer un convertisseur (donc un handler curl) pour faire un test.

Pour un seul test (sur le titre de niveau 1), on peut le comprendre, mais lorsque vous allez devoir faire des tests sur les autres particularités du format markdown, créer un nouveau descripteur pour chaque test va impacter les performances...

Pour améliorer tout ça, nous n’allons créer qu’un seul convertisseur global à la classe, utiliser les méthodes `setUpBeforeClass()` l’utiliser pour l’ensemble des cas de tests. Le squelette suivant peut être inséré et complété (n’oubliez pas de modifier votre cas de test) :

```php
protected static $converter;

public static function setUpBeforeClass():void
{
    // TODO
}

public static function tearDownAfterClass():void
{
    // TODO
}
```

Complétez ces tests pour vérifier d’autres aspects du format. Vous pouvez également récupérer les tests du TP5.

> :warning: Cette histoire de performance n’est effectivement qu’un prétexte pour vous faire manipuler ce genre de construction car si on voulait vraiment résoudre ce problème, on utiliserait d’autres leviers comme paralléliser les requêtes (_i.e._ [paratest](https://github.com/paratestphp/paratest)) ou complexifier les cas de tests pour couvrir plusieurs points de la syntaxe (ils seront donc moins unitaire).







