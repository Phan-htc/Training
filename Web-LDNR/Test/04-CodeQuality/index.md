---
title: Qualité de code
---

> Dans ce TP, vous allez ajouter des outils d’analyse statique de code pour améliorer sa qualité.

# PHP Code sniffer

Lorsqu’un projet prend de l’ampleur et que de plus en plus de développeurs différents s’impliquent dans son code, l’utilisation de conventions de code différentes et parfois très personnelles rendent sa lecture et sa maintenance plus difficile.

> Songez simplement à un code où certains développeurs utilisent des tabulations, d’autres des espaces (certaines de 2 espaces, d’autres de 4 et d’autres de 8).

Mais une fois une convention choisie, il faut encore la respecter... Ce qui nécessite des revues de codes systématiques et pointilleuses sur cet aspect. Ça alourdi le processus, se fait au détriment des autres aspects positifs des revues de code (transmission du savoir, cohérence d’ensemble, vérification).

C’est tout l’intérêt d’outils de vérification du respect des styles de codage comme _indent_ et, pour ce TP, _PHP Code Sniffer_ ([disponible sur Github](https://github.com/squizlabs/PHP_CodeSniffer)).

## Installation

Comme nous utilisons déjà _composer_ nous allons l’utiliser pour installer _PHP Code Sniffer_. À partir de la racine de votre projet, exécutez la commande suivante :

```php
./composer.phar require --dev "squizlabs/php_codesniffer=*"
```

Après avoir vérifié les dépendances et téléchargé les fichiers nécessaires, composer vous rend la main. Vous pouvez tester que les commandes `phpcs` et `phpcbf` sont disponibles en les lançant sans argument :

```bash
./vendor/bin/phpcs
./vendor/bin/phpcbf
```

## Vérification

Par défaut, `phpcs` vérifier le code suivant [la norme de codage PEAR](https://pear.php.net/manual/en/standards.php). Bien que les normes se valent généralement les unes les autres, nous allons, arbitrairement, suivre la norme [PSR12](https://www.php-fig.org/psr/psr-12/).

A partir de la racine de votre projet, lancez la commande suivante :

```bash
./vendor/bin/phpcs --standard=psr12 ./classes
```

`phpcs` va alors lire le contenu du répertoire `classes` (donc vos classes) et vérifier que votre code respecte les règles. Pour chaque fichier, il vous écrira un tableau mentionnant la ligne de l’erreur, sa gravité et la règle violée.

Même si le code des tests n’a pas vocation à être livré, il doit aussi être maintenu et il est donc utile de le vérifier également :

```bash
./vendor/bin/phpcs --standard=psr12 ./tests
```

## Correction automatique

Lorsqu’on voit le nombre de violation au règles que cet outil remonte, il peut être décourageant de l’utiliser car on imagine déjà le _temps perdu_ à les corriger...

C’est pour ça que _PHP Code Sniffer_ fourni un deuxième outil, `phpcbf ` (pour _**c**ode **b**eauti**f**ier_) , qui va justement se charger de la grande majorité des corrections pour vous. Toutes les violations précédées d’un `[x]` dans leur description sont éligibles à ces corrections automatiques.

Lancez maintenant `phpcbf` sur les répertoires de vos classes et vos tests avec la ligne de commande suivante :

```bash
./vendor/bin/phpcbf --standard=psr12 classes/ tests/
```

`phpcbf` va alors lire et modifier tous les fichiers de ces répertoires et corriger la plupart des violations. Il vous fait ensuite un résumé sur la sortie standard en vous disant, pour chaque fichier, le nombre de corrections faites et le nombre de violation qu’il vous reste à faire vous-même.

## Correction manuelle

> Il y a deux manières de résoudre les violations de règles de style et nous allons les voir toutes les deux sur un exemple.

Certaines règles ne peuvent pas être corrigées automatiquement par les outils car elles impliquent des choix et des conséquences dont l’outil ne peut prendre la responsabilité. Prenons l’exemple de la violation qui a forcément été levée pour votre fichier de test de la classe Math, `MathTest.php`.

```text
FILE: /var/www/php/tests/MathTest.php
-----------------------------------------------------------------------------------------------
FOUND 1 ERROR AFFECTING 1 LINE
-----------------------------------------------------------------------------------------------
 5 | ERROR | Each class must be in a namespace of at least one level (a top-level vendor name)
-----------------------------------------------------------------------------------------------
```

Le standard PSR12 impose en effet que toutes les classes soient organisées dans un namespace. Aucune classe ne peut donc être déclarée sans namespace d’après ce standard.

### Corriger l’erreur

Dans l’immense majorité des cas, je vous conseille de vous conformer au standard. Parce que si vous et votre équipe avez choisi (ou créé) un standard comprenant cette règle, c’est qu’il y a une raison. Et parce que respecter ces règles rend le code plus homogène et que c’est le but qu’on s’est fixé ici.

Pour notre exemple, le problème est que les classes de test que nous avons développé jusqu’ici sont toutes globales, elles ne font partie d’aucun namespace. Il suffit donc de leur spécifier un namespace et pour ça, deux écoles :

1. Vous leur donnez le même namespace que la classe qui est testée,
2. Vous créez un namespace spécifique pour toutes les classes de test.

> :warning: Puisque vos fichiers sont maintenant dans un namespace, les classes de PHP (qui se trouvent à la racine de tous les namespaces) doivent maintenant être préfixées d’un antislash (ou faire l’objet d’une déclaration `use` en tête de fichier). C’est plus particulièrement le cas des exception si vous avez utilisé `expectException(\Exception::class)`.

Choisissons arbitrairement la première manière et modifiez le fichier de test comme suit :

```php
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    public function testMaximumOne()
    {
        $this->assertEquals(0, Math::maximum(0, 0));
        $this->assertEquals(1, Math::maximum(0, 1));
        $this->assertEquals(1, Math::maximum(1, 0));
        $this->assertEquals(1, Math::maximum(1, 1));
    }
}
```

Vous pouvez maintenant relancer les tests pour vérifier que tout s’est bien passé :

* `phpcbf` si vous craignez que votre modification ait ajouté ou oublié un espace ou ce genre de chose,
* `phpcs` pour vérifier que votre fichier est maintenant dans le bon style,
* `phpunit` pour vérifier que vos tests fonctionnent toujours.

### Ignorer la règle

Dans certains cas, vous avez rencontré les limites de la règle. Elle est bien sûr _globalement satisfaisante_ mais pour ce cas particulier-ci, elle est contre-productive.

Comme beaucoup d’autres outils d’analyse statique de code, _PHP Code Sniffer_ dispose d’instruction pour désactiver certaines règles dans certaines zones de vos programmes. Dans notre cas, il faut ajouter, en commentaire, la désactivation d’une règle de PSR1 (inclue dans PSR12) comme suit :

```php
<?php

// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use PHPUnit\Framework\TestCase;
use Tests\Math;

class MathTest extends TestCase
{
    public function testMaximumOne()
    {
        $this->assertEquals(0, Math::maximum(0, 0));
        $this->assertEquals(1, Math::maximum(0, 1));
        $this->assertEquals(1, Math::maximum(1, 0));
        $this->assertEquals(1, Math::maximum(1, 1));
    }
}

```

De même que précédement, vous pouvez relancer les outils de test pour vérifier que tout s’est bien passé.

## Exercice

Corrigez toutes les violations de style qu’il reste dans votre code. Le lancement de `phpcs` sur vos répertoires de classes et de test doit se terminer sans avoir trouvé de problème.

# PHPmd

[PHP Mess Detecor](https://phpmd.org/) (ou plutôt sa commande `phpmd`) est un outil d’analyse statique de code qui va chercher des _code smell_ (soit des _codes qui puent_ en français).

## Installation

Comme pour les précédents outils, nous allons utiliser _composer_ pour gérer cette nouvelle dépendance :

```bash
./composer.phar  require --dev "phpmd/phpmd=*"
```

Pour vous assurer que cet outil est installé, vous pouvez le lancer sans argument (il vous affichera un message d’aide) :

```bash
./vendor/bin/phpmd
```

## Vérification

`phpmd` nécessite trois arguments en ligne de commande :

1. Le code à tester : fichiers ou répertoires, séparés par des virgules.
2. Le format du rapport : text, ansi (texte plus joli avec de la couleur) html (encore plus ergonomique que le texte) et bien d’autres (listés dans le message d’aide),
3. Les règles de détection à utiliser (séparées par des virgules), la liste est donnée dans le message d’aide et le détails de ces règles se trouve [sur la documentation en ligne](https://phpmd.org/rules/index.html).

Lançons l’outil sur les classes, avec un rapport au format ansi utilisant toutes les règles :

```bash
./vendor/bin/phpmd classes/ ansi cleancode,codesize,controversial,design,naming,unusedcode
```

Contrairement à la vérification du style où il est conseillé de le faire sur les classes **et** sur les tests, pour ces vérifications-ci, c’est moins tranché.

* Bien sûr améliorer le code des tests est une bonne chose,
* Mais beaucoup de ces règles ne sont pas pertinentes dans des tests et vous allez perdre votre temps à les désactiver à chaque fois.

## Désactivation

Encore plus que les règles de style, ces règles-ci ne devraient presque jamais être désactivées. La violation de ces règles induit des dettes techniques pour laquelle vous devrez payer les intérêts. Même minimes, mis bout à bout, ils représentent une belle somme.

Mais comme toujours, il y a des cas où ces règles rencontrent leurs limites et il est plus pertinent de les désactiver. Comme précédemment, une annotation en commentaire permet de le faire.

Reprenons la classe Math qui contient une méthode avec deux paramètres dont les noms sont trop courts d’après `phpmd`:

```text
FILE: /var/www/php/classes/Math.php
-----------------------------------
 7   | VIOLATION | Avoid variables with short names like $a. Configured minimum length is 3.
 7   | VIOLATION | Avoid variables with short names like $b. Configured minimum length is 3.
```

Imposer des variables dont le nom fait au moins 3 caractère garanti que leur nom soit plus significatif et donc plus facile à comprendre pour un lecteur non averti à qui on a demandé une modification de votre code. Cette règle a donc une bonne raison d’être.

Mais dans notre cas, la fonction maximum prend deux paramètre qui n’ont pas de sens particulier, elle renvoie le plus grand des deux mais sans avoir besoin de savoir à quoi ils correspondent. On pourrait bien sûr les renommer `$parametre1` et `$parametre2` mais ce serait hypocrite : on respecte la règle formelle des trois caractères, mais ces noms n’apportent pas de sens.

Comme les autres outils, `phpmd` dispose d’[annotations permettant de désactiver des règles](https://phpmd.org/documentation/suppress-warnings.html) sur des portions de code. C’est ce que nous allons mettre en œuvre pour cette méthode particulière :

```php
<?php

namespace Tests ;

class Math
{
	/**
	 * @SuppressWarnings(PHPMD.ShortVariable)
	 */
    public static function maximum($a, $b)
    {
        return $a > $b ? $a : $b ;
    }
}
```

## Exercice

Corrigez le plus de violations possibles dans le code de vos classes. N’oubliez pas de lancer les tests unitaires régulièrement pour éviter les régressions.





