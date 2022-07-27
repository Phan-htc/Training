---
title: Vérifier
---

# Comment tester

## Les assertions

Lors du précédent TP, nous avions utilisé une méthode d’assertion pour vérifier que la valeur calculée par la fonction `maximum()` était conforme à celle attendue.

```php
$this->assertEquals(1, Tests\Math::maximum(0, 1));
```

PHPUnit dispose en réalité de bien plus de méthodes d’assertions vous permettant d’écrire des vérifications plus ou moins complexes sur les valeurs retournées par vos fonctions :

* Tester l’égalité (`assertEquals`), l’équivalence (`assertSame`) et la valeur nulle (`assertNull`),
* Tester avec des comparaison arithmétiques (`assertGreaterThan`, ...),
* Tester des chaînes par leur extrêmités (`assertStringStartsWith` et `assertStringEndsWith`) et par expression régulière (`assertRegExp`),
* Tester le contenu des tableaux, une clé (`assertArrayHasKey`), une valeur (`assertContains`), un sous-ensemble (`assertArraySubset`), ...
* Tester le système de fichier, des formats spécifiques (JSON et XML),
* Plus basiquement tester une valeur vraie (`assertTrue`), fausse (`assertFalse`) ou faire échouer manuellement ([fail()](https://pear.php.net/package/PHPUnit/docs/latest/PHPUnit/PHPUnit_Assert.html#methodfail)).

Vous trouverez la documentation de ces méthodes sur ces deux pages :

* Dans la documentation française de PHPUnit : https://phpunit.readthedocs.io/fr/latest/assertions.html
* Dans la documentation officielle du code source : https://pear.php.net/package/PHPUnit/docs/latest/PHPUnit/PHPUnit_Assert.html

## Les erreurs et exceptions

Dans certains cas, les fonctions testées sont sensé lancer des erreurs d’exécution ou des exceptions. Admettons que ce soit le cas d’une fonction `dostuff()`.

Comme dans l’exemple suivant, nous pourrions écrire une fonction de test qui encadrerait l’appel par un `try/catch` et utilise des assertions pour vérifier que tout s’est passé normalement.

```php
public function testException() {
    try {
        dostuff() ;
        $this->fail() ;
    } catch (Exception $e) {
        $this->assertTrue(true) ;
    }
}
```

Bien que ça fonctionne, ça n’est pas pratique car en cas de non-conformité, les messages d’erreur de PHPUnit ne seront pas très explicatifs.

Il vaut mieux alors utiliser la [gestion des exceptions de PHPUnit](https://phpunit.readthedocs.io/fr/latest/writing-tests-for-phpunit.html#tester-des-exceptions) qui propose une méthode dédiée. Le test est alors plus lisible et les messages seront d’autant plus pertinents.

```php
public function testException() {
    $this->expectException(Exception::class);
    dostuff() ;
}
```

## Sortie écran

Même si cette pratique tend à disparaître, il vous arrivera de devoir tester des fonctions qui effectuent des écritures sur la _sortie écran_ (appels à `echo` et `print`). Comme cette fonction d’exemple :

```php
function doHelloWorld() {
	echo "Hello world !\n" ;
}
```

Pour tester son comportement, vous pourriez utiliser [la bufferisation de sortie de PHP](https://www.php.net/manual/fr/ref.outcontrol.php) puis des assertions classique comme suit :

```php
public function testHelloWorld() {
    ob_start() ;
    doHelloWorld() ;
    $output = ob_get_flush() ;

    $this->assertEquals("Hello world !\n", $output) ;
}
```

Même si ça fonctionne, PHPUnit fournit une méthode plus lisible pour obtenir le même résultat :

```php
public function testHelloWorld() {
    $this->expectOutputString("Hello world !\n") ;
    doHelloWorld() ;
}
```

La [documentation](https://phpunit.readthedocs.io/fr/latest/writing-tests-for-phpunit.html#tester-la-sortie-ecran) liste d’autres méthodes pour tester la sortie écran de vos fonctions.

## Un cas de test = une fonction

Ce n’est pas imposé par PHPUnit mais tiens plus d’une _bonne pratique_, je vous conseille de séparer vos cas et scénarios de tests dans des fonctions séparées. L’avantage que vous y gagnez ? D’une part le nom de la fonction permet d’exprimer ce qu’elle est en train de tester et, en cas d’erreur détecter, il est plus facile de retrouver où le problème se pose.

> ⚠ Rappel au cas où, le nom de vos fonctions de test doit commencer par « test ».

# Exercice, tester une pile

> À l'aide des méthodes vues plus haut, vous allez tester (et corriger) l'implémentation d'une pile.

Les piles sont des conteneurs permettant d'y insérer, accéder et retirer des données dans un ordre particulier. Chaque élément est placé _en haut_ de la pile et l'accès (et retrait) se fait par le haut. Ainsi les prochaines éléments à _sortir_ seront les derniers à y avoir été insérés (_Last In First Out_ en anglais).

En particulier, les piles de cet exercice doivent implémenter les 4 méthodes suivante :

1. `empty()` qui permet de savoir lorsqu'une pile est vide,
2. `push()` qui permet d'ajouter un élément au sommet de la pile,
3. `head()` qui fourni l'élément en sommet de pile (sans le dépiler),
4. `pop()` qui fourni l'élément en sommet de pile (après l'avoir dépilé).

La définition exacte de cette interface vous est données dans [le fichier Pile.php](Pile.php.txt) que vous pouvez télécharger et copier dans le répertoire contenant les classes de votre projet.

L'implémentation de cette interface que vous devez tester (et corriger) est disponible dans [le fichier PileTableau.php](PileTableau.php.txt) que vous pouvez également télécharger et copier dans votre projet.

## Quand corriger ?

Lorsque vous allez ajouter vos cas de tests, vous allez vouloir les lancer régulièrement pour vérifier qu'ils fonctionnent et, ce faisant, vous allez découvrir des erreurs. Après avoir vérifié que votre cas de test est bon, se posera alors la question...

> Quand corriger le code ?

Il n’y a pas de réponse tranchée et deux écoles co-existent :

* **Corriger au fur et à mesure.** Comme ça, chaque fois que vous voyez une erreur, c’est une nouvelle erreur et vous pouvez vous concentrer un cas de test à la fois (et oublier les précédents).
* **Corriger à la fin.** Comme ça, vous vous concentrez d’abord sur vos tests (ça évite de perdre le fil) puis vous concentrer sur le code et le corriger.

Vous pouvez aussi marier les deux principes : écrire des fonctions vides pour chaque cas de test (le nom dira ce que c’est sensé tester et au pire, vous ajoutez quelques commentaires), puis en deuxième phase vous implémentez les tests. Le TP 5 vous donnera des moyens pour améliorer cette méthode.

## Besoin d'idées ?

Si vous êtes bloqués et ne savez pas par quel tests commencer (ou avez un doute d'avoir tout testé[^all]), voici une liste de tests que vous pourriez implémenter :

[^all]: On n'a jamais fini de tout tester, tout ce qu'on peut faire, c'est augmenter la couverture.

1. Une pile créée est vide,
2. Après un push, une pile vide ne l'est plus,
3. Pop sur une pile vide génère une exception,
4. Head sur une pile vide génère une exception,
5. Pop après push sur une pile vide la rend vide à nouveau,
6. On ne peut pas faire pop deux fois après un seul push,
7. On peut faire deux fois head après un seul push,
8. Après un push, pop retourne cette valeur,
9. Après deux push, deux pop retournent ces valeurs dans l'ordre inverse
10. Idem après trois push,
11. Après un push, deux head retourne cette même valeur deux fois,
12. Après deux push, head retourne deux head retournent la dernière valeur insérée, deux fois.

# Exercices supplémentaires

Si le test de la pile vous a plu et êtes chauds pour continuer à tester mes implémentations (toujours pertinentes), voici quelques nouvelles fonctions à ajouter et à tester.

## Multiplier par 10

On l’a tous appris à l’école, pour multiplier par dix, il suffit d’ajouter un zéro. C’est ce que fait cette fonction (à ajouter à la classe Math).

```php
public static function multiplyByTen($a) {
    // Add a leading 0 to "multiply by ten"
    return $a . "0" ;
}
```

Ça marche car PHP peut convertir le nombre `$a` en chaîne (représentation décimale) puis lui ajouter un 0.

Si vous testez avec `assertEquals()`, vous ne verrez pas le problème... Essayez avec `assertSame()` et `assertInternalType()`.

## Tester la sortie écran

Ajouter à la classe PileTableau la fonction de débogage suivante :

```php
public function debug() {
    print "[" . implode($this->data[0], str_split(", ")) . "]\n" ;
}
```

Ajoutez maintenant des tests pour vérifier que cette fonction est correcte et affiche le contenu de la pile, séparés par des `, ` (virgule et espace), le tout encadré par des crochets `[]` suivi d’une fin de ligne.
