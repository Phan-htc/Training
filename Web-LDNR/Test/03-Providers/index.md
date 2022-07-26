---
title: Fournisseurs
---

> Dans ce TP vous allez utiliser des dépendances entre méthodes pour permettre à PHPUnit d'orchestrer vos tests et d'appeler vos méthodes dans le bon ordre.

# Dépendance

## Principe

Pour retrouver facilement la source d'une erreur, un test ne devrait faire qu'un minimum d'opérations et de vérifications à la fois.

Pour éviter de répéter du code lorsque vos tests nécessitent que vos données empruntent certaines étapes communes, vous pouvez indiquer à PHPUnit que ces tests dépendent les uns des autres ; le résultat des premiers sera fourni en paramètre aux autres.

Par exemple, revenons sur les tests des piles du TP précédent. Pour tester qu'une pile est initialement vide mais ne l'est plus après un push, vous pourriez avoir implémenté les deux tests suivants :

```php
public function testConstructeurRetourneUnePileVide()
{
    $pile = new PileTableau() ;
    $this->assertTrue($pile->empty()) ;
}

public function testNePeutPasPopUnePileVide() {
    $this->expectException(Exception::class);
    $pile = new PileTableau() ;
    $value = $pile->pop() ;
}
```

Puisque le deuxième test a besoin d'une pile vide récemment créée, nous pouvons l'indiquer à PHPUnit :

1. En retournant la pile dans le premier test,
2. En mentionnant cette dépendance en annotation de documentation du deuxième test,
3. En déclarant un paramètre à ce deuxième test.

Le code suivant vous montre à quoi ressembleraient alors les tests précédents :

```php
public function testConstructeurRetourneUnePileVide()
{
    $pile = new PileTableau() ;
    $this->assertTrue($pile->empty()) ;
    return $pile ;
}

/**
 * @depends testConstructeurRetourneUnePileVide
 */
public function testNePeutPasPopUnePileVide($pile) {
    $this->expectException(Exception::class);
    $value = $pile->pop() ;
}
```

PHPUnit vous permet d'indiquer qu'un test dépend de plusieurs autres tests, il faudra alors déclarer autant de paramètres. Vous trouverez les détails dans [la documentation](https://phpunit.readthedocs.io/fr/latest/writing-tests-for-phpunit.html#dependances-des-tests) (**Lisez la note en bleu**).

## Exercice

Reprenez vos tests des piles du TP précédent et factorisez le code en exprimant des dépendances entre vos tests.

# Fournisseurs

## Principe

Bien souvent, plusieurs tests ne diffèrent que par les données en entrée et en sortie du test. Les étapes sont identiques, seuls les paramètres fourni aux fonctions changent.

Par exemple, revenons sur la fonction `maximum` du premier TP qui contenait 4 assertions pour les 4 cas de tests. Pour _bien faire_, nous aurions du séparer chaque cas de test dans une fonction spécifique (afin de pouvoir plus facilement identifier le cas problématique) mais le code en aurait été d'autant plus grand et l'intérêt aurait été limité.

```php
public function testMaximumOne()
{
    $this->assertEquals(0, Tests\Math::maximum(0, 0));
    $this->assertEquals(1, Tests\Math::maximum(0, 1));
    $this->assertEquals(1, Tests\Math::maximum(1, 0));
    $this->assertEquals(1, Tests\Math::maximum(1, 1));
}
```



Pour séparer les cas tout en rendant le code simple, PHPUnit nous permet de séparer la création des cas de tests avec leur vérification.

1. Une première fonction retourne les paramètres et valeurs attendues,
2. Une deuxième fonction prend ces valeurs en paramètre,
3. Une annotation en commentaire de la seconde indique que les données sont créées par la première.

```php
public function maximumProvider() {
    return [
        [0, 0, 0],
        [0, 1, 1],
        [1, 0, 1],
        [1, 1, 1]
    ] ;
}

/**
 * @dataProvider maximumProvider
 */
public function testMaximum($a, $b, $expected) {
    $this->assertEquals($expected, Tests\Math::maximum($a, $b));
}
```

Dans un cas aussi simple, on peut se poser la question de l'intérêt d'ajouter une fonction et autant de ligne pour obtenir le même résultat... Mais il devient évident lorsqu'on veut, rapidement, ajouter de nouveaux cas de tests (_e.g._ des nombres négatifs, des chaînes, des tableaux, un mélange de tout ça).

Au delà d'un simple tableau avec les valeurs, vous pouvez également nommer vos jeux de tests (l'affichage des erreurs en sera enrichi), retourner [des itérateurs](https://www.php.net/manual/fr/class.iterator) ou même [des générateurs](https://www.php.net/manual/fr/language.generators.overview.php). Vous trouverez des exemples et des détails dans [la documentation](https://phpunit.readthedocs.io/fr/latest/writing-tests-for-phpunit.html#fournisseur-de-donnees) (y compris sur la manière d'utiliser des dépendances et des fournisseurs pour un même test).

## Exercice

Pour cet exercice, vous allez tester (et corriger) deux fonction sur les dates. Celles-ci sont disponibles dans [la classe Date.php](Date.php.txt) que vous pouvez télécharger et copier dans votre projet.

Les deux fonctions à tester sont les suivantes :

1. `bissextile()` qui vous retourne si une date est bissextile ou non,
2. `lendemain()` qui vous retourne le lendemain d'une date passée en paramètre.