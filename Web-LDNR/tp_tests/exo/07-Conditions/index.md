---
title: Couverture des conditions
---

> Dans le TP précédent, nous avons considéré qu’un code est couvert si toutes ses instructions ont été couvertes par au moins un test. Nous allons améliorer cette couverture concernant les conditions.

# Code initial

Pour ce TP, vous allez tester (et corriger) une fonction qui déterminer si un mot de passe est fort ou pas. Ce genre de fonction pourrait être utilisée pour contrôler la validité des données d’un formulaire web de création de compte utilisateur ou de modification de mot de passe.

L’ANSSI propose une [page avec les détails](https://www.ssi.gouv.fr/administration/precautions-elementaires/calculer-la-force-dun-mot-de-passe/) mais pour ce qui nous concerne aujourd’hui, nous pouvons simplifier et considérer que, suivant l’ensemble des caractères utilisés dans un mot de passe (son alphabet), celui-ci sera fort si sa longueur dépasse un seuil tel que défini dans le tableau suivant :

| Alphabet                           | Taille Alphabet | Longueur minimale |
| ---------------------------------- | --------------- | ----------------- |
| Chiffres                           | 10              | 31                |
| Lettres                            | 26              | 22                |
| Lettres et chiffres                | 36              | 20                |
| Majuscules et minuscules           | 52              | 18                |
| Majuscules, minuscules et chiffres | 62              | 17                |

## Les fichiers

Pour commencer, téléchargez et copiez les deux fichiers suivants dans votre projet :

* [Pass.php](Pass.php.txt), qui contient l’implémentation d’une telle fonction,
* [PassTest.php](PassTest.php.txt), qui contient un test unitaire permettant de couvrir 100% des instructions.

Une fois ces fichiers en place, lancez PHPUnit en lui demandant un rapport de couverture de code et constatez que le code de la classe _Pass_ est bien couvert à 100%. Les tests contiennent un mot de passe faible, un autre fort et couvriraient donc _tous les cas possibles_.

## Problème de complexité cyclomatique

Sans rentrer dans les détails, la complexité cyclomatique mesure le nombre de décisions prises dans un code. Il ne s’agit pas du nombre d’instructions conditionnelles (_i.e._ `if`) mais bien de _points de décisions_. Si la condition porte sur deux variables, il y aura deux points de décisions (la première et la seconde variable).

Les outils introduits jusqu’ici vous permettent de voir que la fonction `estFort()` pose un problème de complexité cyclomatique :

* **PHPUnit :** le _dashboard_ du rapport de couverture proposes deux graphiques qui placent les classes et les méthodes suivant leur complexité cyclomatique. Ils indiquent une complexité de 16 pour la classe _Pass_ et sa méthode `estFort()`.
* **phpmd :** lorsque vous lui demandez d’analyser les classes de votre projet, il vous informe d’une violation ; la méthode `estFort()` a une complexité de 16, supérieure au seuil (10).

```text
 29 | VIOLATION | The method estFort() has a Cyclomatic Complexity of 16. The configured cyclomatic complexity threshold is 10.
```

Puisque la complexité cyclomatique vous donne le nombre de tests pour couvrir ces décisions, qu’elle vaut 16 et qu’il n’y a pour l’instant que deux tests, il en manque 14.

# Exercice

Ces exercices ont pour but de compléter la couverture de ces décisions par de nouveaux tests. Lorsque de nouveaux tests échoueront, vérifiez les tests et le code et corrigez-les en conséquence.

## Toutes les conditions - décisions

Ce critère impose que vos cas de tests comportent, en plus d’un cas globalement vrai et l’autre globalement faux, pour chaque variable, un cas où cette variable est vraie un un cas où elle est fausse.

Ajoutez des cas de tests pour respecter ce critère.

## Toutes les conditions - décisions modifiées

Ce critère est plus exigeant que le précédent. Il impose que pour chaque variable, il existe deux cas de tests dont seule cette variable change de valeur et que ce changement fasse également changer la valeur globale de l’expression.

Ajoutez des cas de tests pour respecter ce critère.

## Toutes les décisions

Ce critère est encore plus exigeant et impose que chaque décision de la formule booléenne soit couverte par un cas de test.

Ajouter des cas de tests pour couvrir toutes ces décisions (16 suffisent).

# Refactorisation

Maintenant que vous disposez d’une campagne de test qui couvre cette condition, vous pouvez _améliorer_ le code pour le rendre plus lisible et maintenable avec l’assurance que vous ne risquez plus d’introduire de régression.

Si vous n’avez pas d’idée, la suite est faite pour vous. Pour les autres, suivez votre instinct.

## Utiliser l’entropie

Le calcul de la _force_ d’un mot de passe est en fait [une comparaison de l’entropie](https://www.ssi.gouv.fr/administration/precautions-elementaires/calculer-la-force-dun-mot-de-passe/) d’un mot de passe avec un seuil (100 bits). Il _suffit_ donc de calculer cette entropie, de la comparer un ce seuil et vous avez votre booléen.

Il faut donc [calculer l’entropie](https://www.arsouyes.org/blog/2020/37_Entropie)... mais comme on part du principe que ces mots de passes sont générés en ajoutant des caractères aléatoires et indépendants, la formule est en fait plutôt simple : il faut multiplier l’entropie d’un caractère par la longueur du mot de passe.

Et quelle est l’entropie d’un seul caractère ? C’est le logarithme en base 2 du nombre d’éléments de l’ensemble dans lequel il a été tiré aléatoirement. Les minuscules apportent 26 symboles, les majuscules aussi et les chiffres en apportent 10.

