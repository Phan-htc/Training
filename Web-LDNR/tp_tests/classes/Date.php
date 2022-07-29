<?php

namespace Tests ;

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
		echo " l'année est bissextile";
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
		
		switch($date) {
			case '01' :
				if ($day !== '31') {
					$day = sprintf("%02d", $day + 1) ;
				} else {
					$month = sprintf("%02d", $month + 1) ;
				}
				break ;
			default :
					$day = sprintf("%02d", $day = 1) ;
					$month = sprintf("%02d", $month = 1) ;
					$year = sprintf("%04d", $year + 1) ;
		}		
		return "$day-$month-$year" ;
	}	
}