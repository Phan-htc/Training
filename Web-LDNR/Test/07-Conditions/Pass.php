<?php

namespace Tests ;

class Pass
{
    /**
     * Déterminer si un mot de passe est _fort_.
     *
     * Un mot de passe est considéré comme fort si le nombre de tentatives
     * pour le découvrir est suffisament grand, d'après l'ANSSI, de l'ordre
     * de 2^100 (soit 100 bits d'entropie).
     *
     * La difficulté d'un mot de passe dépend à la fois des caractères
     * utilisés et de leur nombre. Voici la longueur minimale pour
     * des alphabets usuels :
     *
     * * Chiffres : 31
     * * Lettres  : 22
     * * Lettres et chiffres : 20
     * * Majuscules et minuscules : 18
     * * Majuscules, minuscules et chiffres : 17
     *
     * @param $motdepasse Le mot de passe à tester
     * @return "Fort" si le mot de passe est fort, "Faible" sinon
     *
     * @see https://www.ssi.gouv.fr/administration/precautions-elementaires/calculer-la-force-dun-mot-de-passe/
     */
    public static function estFort($motdepasse)
    {
        $minuscules = preg_match('/[a-z]/', $motdepasse) == 1 ;
        $majuscules = preg_match('/[A-Z]/', $motdepasse) == 1 ;
        $chiffres   = preg_match('/[0-9]/', $motdepasse) == 1 ;
        $longueur   = strlen($motdepasse) ;

        if (
            ($longueur > 30                                            ) ||
            ($longueur > 21 && $minuscules || $majuscules              ) ||
            ($longueur > 19 && $minuscules || $majuscules && $chiffres ) ||
            ($longueur > 17 && $minuscules && $majuscules              ) ||
            ($longueur > 16 && $minuscules && $majuscules  && $chiffres)
            ) {
			return "Fort" ;
		}
		
		return "Faible" ;
    }
	
	public static function estFort2($motdepasse)
    {
		$cardinal = 0 ;
		if (preg_match('/[a-z]/', $motdepasse) == 1) {
			$cardinal += 26 ;
		}
		
		if (preg_match('/[A-Z]/', $motdepasse) == 1) {
			$cardinal += 26 ;
		}
		
		if (preg_match('/[0-9]/', $motdepasse) == 1) {
			$cardinal += 10 ;
		}
		
		$entropy = strlen($motdepasse) * log($cardinal, 2) ;

		if ($entropy > 100) {
			return "Fort" ;
		}
		
		return "Faible" ;
    }
}
