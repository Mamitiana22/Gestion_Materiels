<?php

namespace models;

// Toutes les méthodes et propriétés nécessaires à la gestion des données de la table materiel
class Materiel
{
    private $table = "materiel";
    private $connexion = null;

    // Les proprietées de l'objet materiel
    public $numMateriel;
    public $design;
    public $etat;
    public $quantite;

    public function __construct($db)
    {
        if ($this->connexion == null) {
            $this->connexion = $db;
        }
    }

    public function listMateriel(){
        $sql = "SELECT numMateriel, design, etat,quantite FROM $this->table";
        return $this->connexion->query($sql);
    }
    public function add(){
        $sql = "INSERT INTO $this->table(design,etat,quantite)VALUES(:design,:etat,:quantite)";

        $req = $this->connexion->prepare($sql);
        return $req->execute([":design" => $this->design, ":etat" => $this->etat, ":quantite" => $this->quantite]);
    }

    public function update()
    {
        $sql = "UPDATE $this->table SET design=:design, etat=:etat, quantite=:quantite WHERE numMateriel=:numMateriel";

        $req = $this->connexion->prepare($sql);
        return $req->execute([":design" => $this->design, ":etat" => $this->etat, ":quantite" => $this->quantite
        ]);
    }

    public function delete()
    {
        $sql = "DELETE FROM $this->table WHERE numMateriel = :numMateriel";
        $req = $this->connexion->prepare($sql);

        return $req->execute(array(":numMateriel" => $this->numMateriel));
    }

    public function fetchMaterielUpdated()
    {
        $sql = "SELECT numMateriel, design, etat,quantite FROM $this->table WHERE numMateriel=:numMateriel";
        return $this->connexion->query($sql);
    }
}
