<?php

namespace Tests ;

use Exception ;

/**
 * Classe (minimaliste[^min]) fournissant des primitives de traduction
 *
 * [^min]: d'autres classes fournissent de meilleures API et fonctionnalités
 *         mais l'objectif ici, c'est de faire du test.
 *
 * Les traductions sont des chaînes contenant des format qui permettent de
 * leur injecter des données. Le format est celui de printf.
 *
 * Elle peut s'utiliser de deux manières :
 *
 * 1. Soit via un objet, qui doit être créé avec une table associative des
 *    clés vers leurs traductions,
 *
 *    La traduction s'effectue comme un appel de méthode ; le nom de la
 *    méthode indique la clé à traduire, les paramètres de la méthode
 *    étant passés à `sprintf()` pour remplacer les formats par leurs
 *    valeur.
 *
 *    Exemple :
 *
 *    ```php
 *    $translator = new I18n([
 *        "HELLO" => "Bonjour %s"
 *    ]) ;
 *    echo $translator->HELLO("tout le monde") ;
 *    ```
 *
 * 2. Soit via les fonctions statiques, qui nécessitent un appel à `setup()`
 *    pour initialiser la table d'après un fichier.
 *
 *    La traduction procède de la même manière mais la méthode est statique.
 *
 *    Exemple :
 *
 *    ```php
 *    I18n::setup("translation.ini") ;
 *    echo I18n::HELLO("tout le monde") ;
 *    ```
 *
 * Le choix du fichier de traduction en fonction de la langue n'est pas
 * de la responsabilité de cette classe, c'est le code qui l'initialise
 * qui doit le faire.
 */
class I18n {
	
	private $translations ;
	
	public function __construct($translations) {
		$this->translations = $translations ;
	}
	
	public function __call($name, $args) {
		if (! array_key_exists($this->translations, $name)) {
			throw new Exception("No Translation found for $name") ;
		}
		
		return printf($this->translations[$name], ...$args) ;
	}
	
	/* -------------------------------------------------------------------- */
	
	private static $instance ;
	
	private static function getInstance() {
		if (! isset(self::$instance)) {
			throw new \Exception("No I18n instance setup") ;
		}
		
		return self::$instance ;
	}
	
	public static function setup($filename) {
		
		$content = @file_get_contents($filename) ;
		if ($content === false) {
			throw new \Exception("Setup file could not be readed") ;
		}
		
		switch (pathinfo($filename, PATHINFO_EXTENSION)) {
			case "ini" :
				$data = @parse_ini_string($content) ;
				if ($data == false) {
					throw new \Exception("Error while reading ini setup file") ;
				}
			case "json" :
				$data = json_decode($content, true) ;
				if ($data == false) {
					throw new \Exception("Error while reading json setup file") ;
				
				break ;
			case "yml" :
				$data = yaml_parse($content) ;
				if ($data == false) 
					throw new \Exception("Error while reading yaml setup file") ;
				}
				break ;
			default :
				throw new \Exception("Extension not recognized as i18n file") ;
		}
		
		self::$instance = new self($data) ;
	}
	
	public static function __callStatic($name, $args) {
		return self::getInstance()->$name(...$args) ;
	}

}