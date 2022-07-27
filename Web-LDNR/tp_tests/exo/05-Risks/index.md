---
title: Tests incomplets et sautés
---



# Cas de test sans test

Il arrive assez régulièrement qu'en voulant tester une classe, vous prévoyez un cas de test mais que vous ne vouliez pas l'implémenter immédiatement...

* Vous préférez écrire les cas de tests puis les implémenter un par un,
* Vous ne savez pas encore comment utiliser l'API pour ce test particulier,
* L'API n'est pas encore disponible ni formellement définie,
* La spécification est floue ou pas encore écrite concernant ce point.

## Exercice

Pour ce test, nous allons ajouter la méthode suivante à la classe _Math_ qui déterminer si un nombre est _déficient_, _parfait_ ou _abondant_ :

```php
/**
 * @SuppressWarnings(PHPMD.ElseExpression)
 */
public static function qualify($number)
{
    $sum = 0 ;
    for ($i = 1; $i < $number; $i++) {
        if ($number % $i == 0) {
            $sum += $i ;
        }
    }

    if ($sum < $number) {
        echo "$number est deficient\n" ;
    } elseif ($sum == $number) {
        echo "$number est parfait\n" ;
    } else {
        echo "$number est abondant\n" ;
    }
}
```

Pour l'instant, ne vous préoccupez pas de ce que fait cette méthode et ce que cache ces notions de déficience, perfection et abondance chez les nombres.

## Test vide

Vous pourriez écrire une méthode de test vide. Quelque chose comme suit :

```php
public function testCasTresParticulier() {
}
```

Dans ce cas, PHPUnit considère cette méthode comme un [test inutile](https://phpunit.readthedocs.io/fr/latest/risky-tests.html#tests-inutiles) et le marquera comme risqué dans son rapport (affichant un `R` au lieu de l'habituel `.`, `E` ou `F`). Mis à part cette information, PHPUnit considèrera son exécution comme réussie (lire : l'intégration continue considèrera qu'il n'y a pas de problème).

> Si, pour une raison ou une autre, vous souhaitez désactiver cette particularité et que ces tests inutiles ne soit pas considéré comme risqués, passez l'option suivante à la ligne de commande : `--dont-report-useless-tests`

### Exercice

Complétez la classe de test de la classe _Math_ avec trois méthodes pour tester les cas de nombres déficients, parfaits et abondants. Laissez ces méthodes vides pour l'instant.

Lancez ensuite PHPUnit comme habituellement et remarquez le rapport qu'il vous fourni.

Lancez ensuite PHPUnit en ajoutant l'option `--dont-report-useless-tests` et remarquez la différence.

## Test incomplet

La méthode précédente peut vide devenir pénible pour les développeurs :

* Soit ces tests sont considérés comme risqués et PHPUnit vous fera un rapport qui les mentionnent tous dans le détails (et rend ainsi le rapport illisible),
* Soit vous lui demandez de les ignorer mais dans ce cas, il ne vous affiche plus rien...

Heureusement, vous pouvez informer PHPUnit que votre [test est incomplet](https://phpunit.readthedocs.io/fr/latest/incomplete-and-skipped-tests.html#tests-incomplets) avec un simple appel de méthode comme suit :

```php
public function testCasTresParticulier() {
    $this->markTestIncomplete(
    	"Ce test n'est pas encore implémenté"
	);
}
```

Cette fois, PHPUnit marquera ce test comme incomplet (avec un caractère `I`) mais ne vous affichera pas de rapport détaillé (puisqu'inutile). Et comme précédemment, il considèrera son exécution comme réussie.

### Exercice

Complétez les trois méthodes précédentes en les considérant comme incomplètes.

Lancez PHPUnit et observez son rapport.

## Exercice

En vous aidant des définitions de wikipédia, complétez les cas de tests pour vérifier (et corriger) la méthode est correcte :

* [Nombres déficients](https://fr.wikipedia.org/wiki/Nombre_d%C3%A9ficient),
* [Nombres parfaits](https://fr.wikipedia.org/wiki/Nombre_parfait),
* [Nombres abondants](https://fr.wikipedia.org/wiki/Nombre_abondant).

# Sauter des tests

Dans d'autres cas, ce n'est pas que vous n'avez rien à écrire dans le test, mais que celui-ci n'a pas toujours un sens à être exécuté ; les tests sont lancés sur plusieurs environnements et un test n'est pertinent que sur certains d'entre eux (système d'exploitation, version de PHP, présence d'une extension, ...).

## Sauter dynamiquement

La première solution consiste à écrire du code permettant de déterminer si le test doit être exécuté et si ce n'est pas le cas, d'informer PHPUnit de [sauter le test](https://phpunit.readthedocs.io/fr/latest/incomplete-and-skipped-tests.html#sauter-des-tests) et de passer au suivant en appelant la méthode `markTestSkipped()` comme suit :

```php
public function testCasTresParticulier() {
    if (! $this->checkCasTresParticulier()) {
        $this->markTestSkipped(
		    'The MySQLi extension is not available.'
        );
    }
}
```

Dans ce cas, PHPUnit marquera ces tests comme sautés avec la lettre `S` et considèrera son exécution comme réussie.

## Sauter statiquement

Comme certains tests de ce genre sont très courant (et pénibles à écrire à chaque fois), PHPUnit vous propose aussi d'utiliser une annotation à insérer en commentaire pour signifier que votre test a certains pré-requis qui, s'ils ne sont pas respectés, rendent le test inutile.

Par exemple, si votre test n'a de sens que sur une machine Linux, vous pourriez l'annoter comme suit :

```php
/**
 * @require OS Linux
 */
public function testCasParticulierSousLinux() {
    // Test spécifique sous Linux
}
```

Pour en savoir plus sur les vérifications disponibles avec ces annotations, rien ne remplacera la lecture de [la documentation](https://phpunit.readthedocs.io/fr/latest/incomplete-and-skipped-tests.html#sauter-des-tests-en-utilisant-requires).

# Exercice : Convertisseur markdown

Pour cet exercice, vous allez tester deux implémentations d'un convertisseur _markdown vers html_ dont l'implémentation utilise la commande [pandoc](https://pandoc.org/). 

## Les fichiers

Pour cela, téléchargez et copiez les fichiers suivants dans votre projet :

* [Markdown.php](Markdown.php.txt) : l'interface qui défini la méthode de conversion
* [MarkdownPandoc.php](MarkdownPandoc.php.txt) : l'implémentation du convertisseur utilisant la commande pandoc,
* [MarkdownMichelf.php](MarkdownMichelf.php.txt) : l’implémentation du convertisseur utilisant l’implémentation de [Michel Fortin](https://github.com/michelf/php-markdown)
* [MarkdownPandocTest.php](MarkdownPandocTest.php.txt) : un début de test unitaire de la conversion markdown vers html.

L’implémentation de Michel Fortin étant disponible via composer, il faut donc lui demander d’installer cette dépendance :

```bash
./composer.phar require michelf/php-markdown
```

## Environnement avec ou sans pandoc ?

Lancez PHPUnit et observez son comportement :

1. Soit vous disposez de pandoc sur votre machine et les tests réussissent,
2. Soit vous ne disposez pas de pandoc et les tests échouent.

Pour éviter que les tests échouent dans le deuxième cas, modifiez le test pour le sauter lorsque pandoc n'est pas disponible (indice : le constructeur lance une exception si pandoc n'est pas disponible).

## Tester l’implémentation de Michel Fortin

Ajoutez une classe de tests unitaires pour tester l’implémentation de Michel Fortin.

> Il peut paraître incongru de tester une librairie fournie par un tiers qui effectue déjà ses propres tests de son côté... Pour quoi les faire deux fois ? Un peu de confiance devrait être de mise.
>
> L’idée est que cette fois on teste que l’implémentation garde un comportement cohérent après des mises à jours. Admettons qu’un comportement sur lequel vous comptiez change après une mise à jours... (point de détail, trou dans la spécification, changement d’idée, correction de bogue, ...). Si vos tests unitaires détectent ces changements, vous évitez une mise en production problématique après avoir «simplement mis les dépendances à jours».

Si vous n’avez pas d’idée de tests, en voici quelques unes :

* Niveaux de titre,
* Paragraphes,
* Italique, gras, barré,
* Liens.