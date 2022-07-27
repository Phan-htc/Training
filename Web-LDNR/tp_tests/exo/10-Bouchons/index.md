---
title: Bouchons
---

Dans beaucoup de situations, l’objet et la classe que vous êtes en train de tester dépendent d’autres objets mais, pour des raisons très légitimes, vous ne voulez pas en instancier des objets. Les _bouchons_ sont là pour vous.

# Contrôleur d’alarme

Pour vous donner un exemple, vous allez tester (et corriger) un contrôleur d’alarme sonore avec _histérésis_. Plutôt que déclencher et arrêter l’alarme dès que le bruit est supérieur ou inférieur au seuil fixé (ce qui génèrerait trop de faux positifs), ce contrôleur-ci va utiliser deux seuils :

* **Le seuil bas :** l’alarme est coupée si le bruit est inférieur à ce seuil,
* **Le seuil haut :** l’alarme est déclenchée si le bruit dépasse ce seuil.

Entre ces deux seuils, l’alarme reste dans son état. Si elle n’était pas déclenchée, le bruit n’est pas assez fort pour la déclencher. Si elle l’était déjà, le bruit n’est pas descendu assez pour l’arrêter.

Téléchargez et copiez les fichiers suivants dans votre projet :

* [Alarm.php](Alarm.php.txt), l’interface des alarmes (avec méthodes `on()`, `off()` et `isOn()`),
* [AlarmController.php](AlarmController.php.txt), l’implémentation du contrôleur d’alarme avec hystérésis,
* [AlarmControllerTest.php](AlarmControllerTest.php.txt), le squelette de la classe pour tester le contrôleur.

Si vous regardez le code source de ces fichiers, vous allez vous rendre compte qu’aucune implémentation d’alarme n’est fournie et qu’il vous est donc impossible d’instancier un contrôleur d’alarme...

# Tester avec des bouchons

Les _bouchons_ sont des objets qui vont imiter les objets officiels dont dépendent vos tests mais sans contenir d’implémentation. Ils sont juste là pour _boucher les trous_.

Exemple sur notre contrôleur d’alarme avec deux tests sur le constructeur :

1. Test nominal avec paramètres valides,
2. Test d’erreur si le seuil bas est supérieur au seuil haut.

Dans les deux cas, vous allez avoir besoin d’une alarme pour instancier votre contrôleur, comment faire ? Avec [un bouchon](https://phpunit.readthedocs.io/fr/latest/test-doubles.html#bouchons).

Pour ces deux tests, nous n’avons besoin que d’un objet implémentant l’interface _Alarm_, on peut donc utiliser la méthode `createMock()` de PHPUnit en lui passant le nom de l’interface à implémenter.

Voici le code pour le premier cas de test ; on crée un bouchon pour l’alarme, on instancie le contrôleur et comme tout s’est bien passé, on ajoute une assertion triviale (pour éviter que le test soit marqué comme risqué).

```php
public function testConstructor1() {
    $mock = $this->createMock(Alarm::class) ;
    $ctrl = new AlarmController($mock, 10, 12) ;
    $this->assertTrue(true) ;
}
```

Ajouter maintenant une fonction pour le second cas de test.

Pour aller plus loin, vérifions le comportement de la méthode `isOn()` du contrôleur. Celui-ci est simple, il doit déléguer cet appel à l’alarme... mais sans alarme ?!

Il faut donc personnaliser le bouchon pour qu’il sache quelle valeur retourner lorsqu’on appelle une de ses méthodes (par défaut, elles retourneraient `null`). L’exemple suivant vous montre comment faire :

```php
public function testIsOn1() {
    $mock = $this->createMock(Alarm::class) ;
    $mock->method("isOn")->willReturn(false) ;
    
    $ctrl = new AlarmController($mock, 10, 12) ;
	$this->assertFalse($ctrl->isOn()) ;
}
```

Ajoutez un cas de test lorsque l’alarme retourne `true`.

> **Pour aller plus loin :** PHPUnit vous permet de personnaliser le retour de valeur des méthodes (une suite, une table de correspondance, des références, un callback, ...), [la documentation](https://phpunit.readthedocs.io/fr/latest/test-doubles.html#bouchons) vous donnera tous les détails.

# Tester avec des Mocks

Les _Mocks_ (je n’ai pas de terme simple en français correspondant) sont des bouchons un peu spéciaux car non seulement ils vont imiter le comportement des objets réels, mais ils vont, en plus, faire des vérifications sur les appels de méthodes qu’ils vont recevoir.

> D’un certain point de vue, contrairement aux assertions qui portent sur des comportements et attributs observables _de l’extérieur_, les _Mocks_ permettent de tester le code _de l’intérieur_.

Continuons à tester notre contrôleur d’alarme, et plus particulièrement sa méthode `notify()` à travers 6 cas de tests :

* Suivant que l’alarme était déjà allumée ou non,
* Suivant que le bruit est inférieur au seuil bas, entre les seuils, supérieur au seuil haut.

Suivant les cas, le contrôleur devra allumer ou éteindre l’alarme et c’est justement ce comportement que nous voulons tester. Nous allons signifier ces _attentes_ (_expectation_ en anglais) à PHPUnit en lui disant si ces méthodes sont sensées être appelées ou pas.

Le code suivant vous montre l’un de ces 6 cas de tests :

```php
public function testNotifyOffHigher() {
    $mock = $this->createMock(Alarm::class) ;
    $mock->method("isOn")->willReturn(false) ;
    $mock->expects($this->once())->method('on') ;
    $mock->expects($this->never())->method('off') ;

    $ctrl = new AlarmController($mock, 10, 12) ;
    $ctrl->notify(13) ;
}
```

Intégrez-le et ajouter les 5 autres cas à vos tests. Corrigez les éventuels problèmes.
