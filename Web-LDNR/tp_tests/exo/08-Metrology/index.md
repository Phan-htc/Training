---
title: Métrologie
---

> La qualité d’un code ne se mesure pas uniquement à sa correction (le fait qu’il fasse ce pourquoi il a été écrit), il faut aussi qu’il le fasse _avec élégance_...

# PHP Metrics

[PHP Metrics](https://github.com/phpmetrics/PhpMetrics) est un outil d’analyse statique de code qui mesure certaines caractéristiques du code source pour avoir une idée plus précise de sa qualité globale mais aussi où celle-ci est meilleure ou fait défaut.

Comme pour les autres outils de ce TP, vous pouvez l’installer via composer avec la commande suivante :

```bash
./composer.phar require --dev "phpmetrics/phpmetrics"
```

Vous pouvez ensuite lancer la commande sans paramètre pour vérifier qu’elle fonctionne, elle vous écrire un message d’aide :

```bash
./vendor/bin/phpmetrics
```

## Métriques de base

Même si `phpmetrics` fourni d’autres formats de rapports, nous allons nous restreindre au format html et le lancer sur les classes avec la commande suivante :

```bash
./vendor/bin/phpmetrics --report-html=./metrics/ classes
```

Cette commande va analyser votre code source puis vous afficher dans la sortie standard un certain nombre de métriques et générer un rapport HTML plus ergonomique dans le répertoire `./metrics/`.

Ouvrez le fichier `./metrics/index.html` avec votre navigateur web et naviguez dans les différentes vues.

## Métrique composer.json

Vous pourriez être intrigué que ces rapports HTML vous disent que `phpmetrics` n’a pas trouvé de fichier `composer.json` alors que vous en avez pourtant un... C’est normal.

Ces graphiques et onglets concernent les dépendances de votre projet, mais uniquement celles « pour la production » (`require`). Les dépendances « pour les développements » (`require-dev`) sont exclues de cette analyse puisqu’elle ne seront pas utilisées en production. Comme vous n’avez pas de dépendance à analyser, phpmetrics n’a rien à afficher (et se trompe de message d’erreur).

Pour que ces graphiques aient un sens, nous allons ajouter une dépendance vers `psr/lopg`([lien sur packagist](https://packagist.org/packages/psr/log)) qui rassemble les interfaces et quelques classes abstraites à utiliser pour implémenter un système de log conforme à la [norme PSR3](https://www.php-fig.org/psr/psr-3/).

```bash
./composer.phar require "psr/log"
```

Vous pouvez maintenant relancer `phpmetrics` comme précédemment et retourner observer le rapport html généré.

> Si vous avez obtenu la version 1.1.14 de `psr/log`, `phpmetrics` vous conseille de la mettre à jours. En temps normal, vous ne devriez avoir à faire qu’un appel à `composer.phar update` pour qu’il aille chercher la nouvelle version. Le problème, c’est que les nouvelles version de `psr/log` (2.0 et 3.0) nécessitent PHP en version 8 ce qui n’est sûrement pas votre cas.

## Métrique de test

Pour nous recentrer sur les tests, et enrichir ces rapports, nous allons intégrer les résultats des tests unitaires effectués par `PHPUnit` à `phpmetrics`.

Première étape, configurer PHPUnit pour générer un rapport dans un format standardisé - JUnit - ce qui se fait très simplement avec l’option `--log-junit <file>`. La commande suivante, en plus des rapports de couvertures, génère ce rapport dans le fichier `junit.xml` :

```bash
./vendor/bin/phpunit \
        --coverage-html /var/www/html/cover/ \
        --coverage-filter classes/ \
        --log-junit junit.xml \
        tests
```

Deuxième étape, configurer `phpmetrics` pour lire ce fichier, ce qui se fait via l’option `--junit <file>`. La commande suivante est adaptée à la précédente :

```bash
./vendor/bin/phpmetrics --junit=junit.xml --report-html=./metrics/ classes,tests
```

Vous pouvez alors retourner observer les rapports de `phpmetrics` ; un nouvel onglet de test unitaire est maintenant disponible.

> **Classes non testées :** le rapport HTML mentionne deux classes non testées mais n’en liste aucune dans le tableau suivant. C’est normal, il s’agit des deux interfaces (_Pile_ et _Markdown_).

# Avant de partir

> Lorsqu’une mesure devient un objectif, elle cesse d’être une bonne mesure.
>
> <cite>Loi de Goodhard, Charles Goodhard</cite>

