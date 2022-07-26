---
title: Couverture
---

> Dans ce TP vous allez utiliser xdebug et phpunit pour quantifier et visualiser la couverture du code par vos tests.

La couverture du code par des tests est un objectif et un critère de qualité d'une campagne de test. Plus le code est couvert, mieux c'est et, inversément, si des zones ne sont pas couvertes, elles constituent un bon endroit pour dénicher d'éventuels problèmes.

# Installer xdebug

[Xdebug](https://xdebug.org/) est une extension de PHP dont le but est de faciliter le travail des développeurs en améliorant les possibilités d'instrumentation et de débogage.

Puisque nous utilisons la version de PHP fournie par les dépôt par défaut de votre distribution GNU/Linux, nous allons faire de même pour l'extension Xdebug. Entrez-donc la commande suivante :

```bash
sudo apt-get install php-xdebug
```

Le but de ce cours et ces TP n'étant pas l'utilisation de Xdebug, je laisse les curieux parcourir [la documentation](https://xdebug.org/docs/) pour en savoir plus.

# Couverture PHPUnit

Maintenant que Xdebug est disponible, PHPUnit va pouvoir l'utiliser pour calculer et vous visualiser la couverture de votre code par votre campagne de test. Pour celà, vous disposez de plusieurs options :

* `--coverage-filter <dir>` pour spécifier où trouver les fichiers PHP à surveiller (dans notre cas, le répertoire classe).
* `--coverage-html <dir>` pour spécifier le répertoire qui contiendra le rapport de couverture en HTML.

La commande suivante illustre l'utilisation de ces deux options pour mesurer la campagne de test sur vos classes.

```bash
./vendor/bin/phpunit --coverage-html ./cover/ --coverage-filter classes/ tests
```

## Problème connu sur debian

Sous certains systèmes (_i.d._ debian), cette commande ne marche pas telle quelle et vous affiche le message d’erreur suivant :

```text
Warning:       XDEBUG_MODE=coverage or xdebug.mode=coverage has to be set
```

C’est parce que, par défaut sous debian, la configuration de php (le fameux fichier `php.ini`) ne défini pas de paramètres pour XDEBUG qui refuse donc d’instrumenter du code sans vous vous l’y autorisiez spécifiquement (ça évite de ralentir un site en production sans le vouloir). Vous avez donc trois solutions (je vous conseille la troisième) :

1. Utiliser la variable d’environnement XDEBUG mais il y a quelques soucis avec PHPUnit (_cf._ [ticket #834 sur github](https://github.com/sebastianbergmann/php-code-coverage/issues/834)),
2. Configurer votre fichier `php.ini` (pour le trouver, lancez `php --ini` et il vous le dira) et ajoutez la ligne `xdebug.mode=coverage`, le problème, c’est que ce sera pour tous les scripts lancés depuis la ligne de commande.
3. Activer l’option lorsque vous lancez php en ligne de commande avec l’option `-d` (ce qui donne `-dxdebug.mode=coverage`).

Donc, pour faire simple, si vous avez rencontré ce problème, utilisez maintenant la ligne de commande suivante pour lancer vos tests unitaires :

```bash
php -dxdebug.mode=coverage ./vendor/bin/phpunit --coverage-html ./cover/ --coverage-filter classes/ tests
```

## Rapport de couverture

A l'issue de cette exécution, ouvrez le fichier `cover/index.html` dans votre navigateur web préféré et parcourez ce rapport de couverture.

* Quels fichiers sont couverts par votre campagne ?
* Pour chaque fichier, quelle proportion de lignes de code est couverte ?
* Quelle proportion de méthodes, et de classes de chaque fichier est couverte ?

Cliquez sur le lien d'un des fichiers (un partiellement couvert serait plus pertinent).

* Quelles lignes sont couvertes ?
* Quelles méthodes sont couvertes ?

Revenez à l'index (en cliquant sur le lien en haut à gauche) puis cliquez sur le lien _Dashboard_ et observez ces graphiques et tableaux.

1. La première partie concerne les classes et vous permet d'avoir une vue globale de la qualité de votre campagne de test et des classes qui sont plus _à risques_ que d'autres.
2. La deuxième concerne les méthodes et vous fourni une vue plus précise des zones les mieux couvertes ou plus à risque.

## Non couvert par choix

Parfois, certaines zone du code n'ont pas vocation à être couverte par un test unitaire. Soit qu'elles ne sont pas testables soit que le test n'aurait aucun sens.

Plutôt que d'inventer des tests inutiles, vous pouvez annoter le code pour dire à PHPUnit [d'ignorer ces zones](https://phpunit.readthedocs.io/fr/latest/code-coverage-analysis.html#ignorer-des-blocs-de-code).

> Comme toutes les annotations qui désactivent des vérifications sur une portion du code, vérifiez plutôt deux fois qu'une que la portion en question mérite effectivement ce traitement de faveur.

## Compléter la couverture

À partir des rapports de couverture de PHPUnit, complétez vos jeux de test pour atteindre une couverture de 100% du code des TP précédents.

# Exercice spécifique

La nouvelle classe à tester (et corriger) fourni des fonctionnalités de traduction sous deux formes. Téléchargez et copier le fichier suivant dans votre projet :

* [I18n.php](I18n.php.txt)

Soit via un objet de traduction contenant les correspondances. La traduction s’effectue par un appel de méthode dont le nom est la clé à traduire et les paramètres sont les données à insérer dans la chaîne de format. Voici un exemple d’utilisation.

```php
$translator = new I18n([
    "HELLO" => "Bonjour %s"
]) ;
echo $translator->HELLO("tout le monde") ;
```

L’autre façon de l’utiliser est de passer par les méthodes statiques. Après avoir initialisé l’instance de référence par la méthode `setup()` et un fichier contenant les correspondantes, la traduction utilise cette fois des méthodes statiques (mais sous le même principe). Voici un exemple :

```php
I18n::setup("translation.ini") ;
echo I18n::HELLO("tout le monde") ;
```

Grâce au rapport de couverture du code, testez (et corrigez) cette classe.

> ⚠ L’utilisation du format yaml nécessite l’extension correspondante. Elle peut s’installer via le paquet `php-yaml` sur presque toutes les distributions.
>
> Plutôt qu’installer un nouveau paquet, vous pouvez aussi choisir de passer ce test si l’extension n’est pas installée. Dans ce cas, la fonction [function_exists()](https://www.php.net/manual/fr/function.function-exists.php) pourra vous être utile pour vérifier que `yaml_parse()` est disponible.
