<?php

namespace Tests ;

/**
 * Implémentation d'une pile.
 *
 * Une pile est un type abstrait de donnée permettant de stocker et récupérer
 * des données dans un ordre particulier : la première donnée à sortir est
 * la dernière à y avoir été stockée (ou _Last In First Out_).
 */
Interface Pile {

	/**
	 * Détermine si la pile est vide.
	 *
	 * @return Vrai si la pile est vide, faux sinon
	 */
	public function empty() ;
	
	/**
	 * Ajoute un élément en haut de la pile
	 *
	 * @param $a l'élément à ajouter
	 */
	public function push($a) ;
	
	/**
	 * Retourne (et enlève) l'élément en haut de la pile
	 *
	 * @return l'élément en haut de pile
	 * @throw Exception si la pile est vide
	 */
	public function pop() ;

	/**
	 * Retourne (sans l'enlever) l'élément en haut de la pile
	 *
	 * @return l'élément en haut de la pile
	 * @throw Exception si la pile est vide
	 */
	public function head() ;

}
