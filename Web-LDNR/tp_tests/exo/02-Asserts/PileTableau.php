<?php

namespace Tests ;

/**
 * Implémentation d'une pile.
 *
 * Une pile est un type abstrait de donnée permettant de stocker et récupérer
 * des données dans un ordre particulier : la première donnée à sortir est
 * la dernière à y avoir été stockée (ou _Last In First Out_).
 */
class PileTableau implements Pile {

	private $data ;

	/**
	 * Construit une nouvelle pile (vide)
	 */
	public function __construct() {
		$this->data = [] ;
	}

	/**
	 * Détermine si la pile est vide.
	 *
	 * @return Vrai si la pile est vide, faux sinon
	 */
	public function empty() {
		return count($this->data) == 0 ;
	}
	
	/**
	 * Ajoute un élément en haut de la pile
	 *
	 * @param $a l'élément à ajouter
	 */
	public function push($a) {
		$this->data[0] = $a ;
	}
	
	/**
	 * Retourne (et enlève) l'élément en haut de la pile
	 *
	 * @return l'élément en haut de pile
	 * @throw Exception si la pile est vide
	 */
	public function pop() {
		if ($this->empty()) {
			throw new \Exception("Can not pop from empty stack") ;
		}
		return $this->data[0] ;
	}

	/**
	 * Retourne (sans l'enlever) l'élément en haut de la pile
	 *
	 * @return l'élément en haut de la pile
	 * @throw Exception si la pile est vide
	 */
	public function head() {
		return $this->data[0] ;
	}
}