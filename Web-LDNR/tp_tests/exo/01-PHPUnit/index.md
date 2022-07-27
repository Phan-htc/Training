---
title: PHP Unit
---

> Lors de ce TP, vous allez installer les pré-requis et effectuer vos premiers tests avec PHPUnit.

# Pré-requis

## PHP



```bash
sudo apt-get install php-cli php-zip php-xml php-curl php-mbstring unzip wget
```

## Composer

> Composer est le gestionnaire de librairie consensuellement utilisé par la communauté des développeurs PHP. Il permet de gérer les dépendances de votre projet pour son environnement de production ainsi que pour son environnement de développement et de test.

Vous pouvez utiliser composer de deux manières :

1. En exécutant un installeur qui va faire quelques tests puis vous copier l’exécutable dans votre système pour être disponible globalement en ligne de commande ;
2. En copiant directement l’exécutable à l’endroit de votre choix (_i.e._ à la racine de votre projet).

Pour éviter de modifier votre système, c’est cette deuxième méthode que nous allons utiliser.

Commencez par créer un répertoire dans lequel vous placerez tous les fichiers de ces TP :

```bash
mkdir tp_tests
cd tp_tests
```

Téléchargez ensuite l’exécutable de composer directement dans ce répertoire.

```bash
wget https://getcomposer.org/download/latest-stable/composer.phar
```

Comme il s’agit d’un exécutable mais que `wget`, par défaut, considère ses téléchargements comme des fichiers, il faut modifier les droits de ce fichier pour en autoriser l’exécution[^chmod].

[^chmod]: Si rendre ce fichier exécutable vous rebute, vous pouvez vous en passer. Dans ce cas, il faudra l’exécuter explicitement via l’interpréteur php : `php composer.phar`.

```bash
chmod a+x ./composer.phar
```

Vous pouvez alors exécuter composer qui, ne voyant pas de projet configuré, vous affichera un message d’aide.

# Installer PHPUnit

> PHP Unit est un ensemble d’exécutables, fonctions et classes vous permettant de mettre plus facilement en place des tests (unitaires) de votre code PHP. Il dépend, lui-même d’autres librairies et paquets, d’où l’intérêt d’utiliser composer pour gérer ces dépendances.

L’installation d’un paquet se fait simplement en invoquant composer et en lui fournissant vos dépendances. Dans la ligne de commande suivante, on lui demande d’ajouter phpunit pour l’environnement de développement.

```bash
./composer.phar require --dev "phpunit/phpunit=^9.5"
```

Cette commande va effectuer des vérifications. Si elles ne sont pas satisfaites, composer arrêtera ses opérations et vous informera des problèmes à régler avant de pouvoir recommencer.

Lorsque tout se passe bien, composer vous informe au fur et à mesure des dépendances trouvées puis de l’installation de ces dépendances. Une fois la commande terminée, vous trouverez de nouveaux éléments dans votre répertoire :

1. `composer.json` est le fichier de configuration du projet (au format JSON), vous pouvez le modifier pour personnaliser les informations, ajouter ou supprimer des dépendances.
2. `composer.lock` est le fichier contenant les dépendances et, surtout, leur version actuellement installées dans votre environnement actuel.
3. `vendor` est le répertoire contenant toutes vos dépendances dont :
   1. `autoload.php` que vous devrez inclure dans vos scripts pour que ces dépendances soit accessibles à vos scripts.
   2. `bin` le répertoire contenant les binaires fournis par vos dépendances, dont `phpunit` que nous allons utiliser.

Pour vous assurer que tout s’est bien passé, vous pouvez lancer phpunit :

```bash
./vendor/bin/phpunit
```

Sans paramètre pour lui dire quoi tester et comment, il va vous afficher un message d’aide.

# Premiers tests

## La classe à tester

Puisque nous utilisons composer pour gérer nos dépendances, il est plus cohérent de l’utiliser aussi pour gérer nos classes en suivant [la norme PSR4](https://www.php-fig.org/psr/psr-4/) qui facilite l’organisation du code et donc sa maintenance.

Commencez par créer un répertoire `classe` qui regroupera les classes de votre projet.

```bash
mkdir classes
```

Dans ce répertoire, créez un fichier `Math.php` ayant le contenu suivant :

```php
<?php

namespace Tests ;

class Math {
	
	public static function maximum($a, $b) {
		return $a > $b ? $a : $b ;
	}

}
```

Il s’agit d’une simple classe `Math` (de l’espace de nom `Test`) contenant une seule méthode statique `maximum()` (qui retourne le maximum des deux paramètres).

Pour dire à composer que votre projet contient maintenant un espace de nom `Test` dont les classes se trouvent dans le répertoire `classes`, il faut modifier le fichier de configuration `composer.json` pour qu’il contiennent le contenu suivant.

```json
{
    "require-dev": {
        "phpunit/phpunit": "^5.5"
    },
	"autoload": {
        "psr-4": {"Tests\\": "classes/"}
    }
}
```

- Le champ `require-dev` est repris tel quel, il a été configuré par composer lorsque nous lui avons demandé d’installer la dépendance (il faudra lui ajouter une virgule pour que le format JSON soit respecté).
- Le champ `autoload` est à ajouter manuellement, il dit à composer que nous configurons un chargeur de classe suivant la norme `psr-4` et que l’espace de nom `Tests` est stocké dans le répertoire `classes`.

Maintenant que la configuration du chargeur de classe a été modifiée, il faut notifier composer de ce changement avec la commande suivante :

```bash
./composer.phar dump-autoload
```

## Le test de la classe

Pour vérifier que votre configuration et le chargeur de classe fonctionnent, vous pouvez créer un fichier `main.php` à la racine de votre projet avec le contenu suivant :

```php
<?php

require __DIR__ . '/vendor/autoload.php';

echo Tests\Math::maximum(0, 0) . "\n" ;
echo Tests\Math::maximum(0, 1) . "\n" ;
echo Tests\Math::maximum(1, 0) . "\n" ;
echo Tests\Math::maximum(1, 1) . "\n" ;
```

Ce fichier inclut le fichier `autoload.php` fourni et créé par composer puis invoque la méthode `maximum()` avec quatre ensemble de paramètres différents.

Vous pouvez exécuter ce script via l’interpréteur PHP comme suit :

```bash
php main.php
```

Il devrait vous afficher un 0 puis trois 1, chacun sur une ligne. Votre code et votre configuration fonctionne donc bien.

> Une fois cette exécution terminée, vous pouvez supprimer ce fichier `main.php`, nous n’en aurons pas besoin dans la suite.

## Le test unitaire de la classe

Tester une fonction manuellement comme précédemment est possible (et c’est souvent cette façon qui est utilisée) mais lorsque le projet grandit et que le nombre de fonction croit, il devient de plus en plus difficile de continuer de cette façon. D’où l’utilisation de tests unitaires.

Commençons par créer un répertoire qui contiendra nos tests :

```bash
mkdir tests
```

Ensuite, dans ce nouveau répertoire, créez un fichier `MathTest.php`[^mathtest] avec ce contenu :

[^mathtest]: Lorsqu’on fait des tests unitaires, il est d’usage qu’à chaque classe dans l’arborescence du projet, corresponde une classe dans l’arborescence des tests (dont on reprend le nom et ajoutons le suffixe `Test`). Ce n’est pas obligatoire mais, comme toute convention, elle rend plus facile la correspondance entre les tests des classes et les classes testées.

```php
<?php

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testMaximum()
    {
        $this->assertEquals(0, Tests\Math::maximum(0, 0));
        $this->assertEquals(1, Tests\Math::maximum(0, 1));
        $this->assertEquals(1, Tests\Math::maximum(1, 0));
        $this->assertEquals(1, Tests\Math::maximum(1, 1));
    }
}
```

Ce fichier crée une nouvelle classe qui étend la classe de test de base et fourni une méthode `testMaximum` qui effectue les mêmes contrôles que précédemment mais en s’assurant elle même que la valeur retournée correspond à celle attendue via l’appel aux assertions de PHPUnit.

> ⚠ Pour PHPUnit, les fonction dont le nom commence par _test_ sont des tests a exécuter. Il s’agit d’une convention, bien pratique, qui évite de devoir ajouter du code pour lui dire quelles fonctions lancer.

Pour lancer ces tests unitaires, il suffit d’exécuter phpunit comme suit :

```bash
./vendor/bin/phpunit tests
```

Sa sortie mérite qu’on s’y attarde un instant. Votre sortie devrait ressembler à la mienne :

```txt
PHPUnit 9.5.21 #StandWithUkraine

.                                                                   1 / 1 (100%)

Time: 36 ms, Memory: 4.00MB

OK (1 test, 4 assertions)
```

La première ligne vous indique la version de PHPUnit en cours d’utilisation (parfois utile pour comprendre la différence de résultat entre plusieurs environnements de tests).

La seconde afficher un résumé des tests exécuté. Pour chaque test, PHPUnit affiche un `.` si le test s’est bien passé, un `F` s’il échoue (et d’autres caractères que nous verrons plus loin dans d’autres cas spécifiques).

Il vous donne ensuite le temps et la mémoire utilisée pour exécuter ces tests et enfin le résultat global de cette campagne de test. Ici, tout s’est bien passé.

> :warning: Dans certaines situations, l'exécution des tests affiche une erreur, `file_put_contents()` n'ayant pas les permissions pour écrire un fichier de cache.  est un problème connu (_i.e._ [Bug #3714](https://github.com/sebastianbergmann/phpunit/issues/3714)). Si telle est votre situation, deux options en ligne de commande peuvent vous aider :
>
> 1. `--do-not-cache-result` qui demande à PHPUnit de ne pas mettre ses résultats en cache. L'exécution sera plus longue mais ces erreurs disparaîtrons.
> 2. `--cache-result-file <file>` qui permet de configurer le nom du fichier qui stockera le cache des tests de PHPUnit.

# Exercices

Dans les exercices suivant, vous allez tester (et corriger) de nouvelles fonctions à ajouter à la classe Math.

## La grande question sur la vie, l'univers et le reste

Ajoutez et vérifiez que cette implémentation résolvant la grande question sur la vie, l’univers et le reste est correcte.

```php
public static function answer() {
    return 6 * 9 ;
}
```

Si vous ne connaissez pas la bonne réponse, vous pouvez la chercher sur internet.

## Conversion en binaire

La fonction suivante calcule la représentation d’une valeur décimale en binaire.

```php
public static function toBase2($value) {
    while ($value > 0) {
        $res = ($value % 2) . $res ;
        $value = intdiv($value, 2) ;
    }
    return $res ;
}
```

## Multiplication par deux

La fonction suivante multiplie par une puissance de deux en effectuant un décallage à gauche (qui devrait donc être bien plus rapide !).

```php
public static function multiplyByPowerOfTwo($a, $power) {
	for ($i = 0; $i < $power; $i++) {
		$a = $a < 1 ;
	}
	return $a ;
}
```

## Nombre de chiffres dans un nombre

La fonction suivante calcule le nombre de fois qu’apparaît un chiffre dans un nombre.

```php
public static function numberOf($haystack, $needle) {
    $res = 0 ;
    foreach (str_split($haystack) as $digit) {
        $res += ($digit = $needle) ;
    }
    return $res ;
}
```

