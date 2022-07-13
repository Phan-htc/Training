<?php
namespace App\Entity;
 
class Personne {
    protected $nom;       // propriétés
    protected $prenom;    // à lier
    protected $dateNaiss; // automatiquement
    protected $numSecu;   // au formulaire
 
    public function getNom() {
        return $this->nom;
    }
 
    public function setNom($nom) {
        $this->nom = $nom;
    }
 
    public function getPrenom() {
        return $this->prenom;
    }
 
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
 
    public function getDateNaiss() {
        return $this->dateNaiss;
    }
 
    public function setDateNaiss($dateNaiss) {
        $this->dateNaiss = $dateNaiss;
    }
 
    public function getNumSecu() {
        return $this->numSecu;
    }
 
    public function setNumSecu($numSecu) {
        $this->numSecu = $numSecu;
    }
}