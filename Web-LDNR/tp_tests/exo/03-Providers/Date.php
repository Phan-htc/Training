<?php

namespace Tests ;

/**
 * Fonctions sur les dates
 */
class Date
{
	
	/**
	 * Vérifier si une année est bissextile
	 * 
	 * @see https://fr.wikipedia.org/wiki/Ann%C3%A9e_bissextile
	 *
	 * @param $annee L'année à vérifier
	 * @return vrai si l'année est bissextile
	 */
	public static function bissextile($annee) {
		return $annee % 4 == 0 ;
	}
	
	/**
	 * Retourne le lendemain d'une date passée en paramètre.
	 *
	 * La date et la valeur de retour doivent être au format jj-mm-aaaa,
	 * c'est à dire le jour sur deux chiffres, un tiret, le mois sur deux
	 * chiffres, un tiret et enfin l'année sur quatre chiffres.
	 *
	 * @param $date La date au format jj-mm-aaaa
	 * @return le lendemain de la date, au même format.
	 * @throw Exception si la date entrée n'est pas valide.
	 */
	public static function lendemain($date) {
		list($d, $m, $y) = explode("-", $date) ;
		
		switch($m) {
			case '02' :
				if ($d == '28') {
					$d = '01' ;
					$m = '03' ;
				} else {
					$d = sprintf("%2d", $d + 1) ;
				}
				break ;
			case '01' :
			case '03' :
			case '05' :
			case '07' :
			case '08' :
			case '10' :
				if ($d == '31') {
					$d = '01' ;
					$m = sprintf("%02d", $m + 1) ;
				} else {
					$d = sprintf("%02d", $d + 1) ;
				}
				break ;
			case '12' :
				if ($d == '31') {
					$d = '01' ;
					$m = '01' ;
					$y = sprintf("%04d", $y + 1) ;
				} else {
					$d = sprintf("%02d", $d + 1) ;
				}
				break ;
			default :
				if ($d == '30') {
					$d = '01' ;
					$m = sprintf("%02d", $m + 1) ;
				} else {
					$d = sprintf("%02d", $d + 1) ;
				}
				break ;
		}
		
		return "$d-$m-$y" ;
	}
	
}