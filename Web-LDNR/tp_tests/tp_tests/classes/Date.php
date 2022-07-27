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
		list($day, $month, $year) = explode("-", $date) ;
		
		switch($m) {
			case '02' :
				if ($day == '28') {
					$day = '01' ;
					$month = '03' ;
				} else {
					$day = sprintf("%2d", $day + 1) ;
				}
				break ;
			case '01' :
			case '03' :
			case '05' :
			case '07' :
			case '08' :
			case '10' :
				if ($day == '31') {
					$day = '01' ;
					$month = sprintf("%02d", $month + 1) ;
				} else {
					$day = sprintf("%02d", $day + 1) ;
				}
				break ;
			case '12' :
				if ($day == '31') {
					$day = '01' ;
					$month = '01' ;
					$year = sprintf("%04d", $year + 1) ;
				} else {
					$day = sprintf("%02d", $day + 1) ;
				}
				break ;
			default :
				if ($day == '30') {
					$day = '01' ;
					$month = sprintf("%02d", $month + 1) ;
				} else {
					$day = sprintf("%02d", $day + 1) ;
				}
				break ;
		}
		
		return "$day-$month-$year" ;
	}
	
}