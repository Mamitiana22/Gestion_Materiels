<?php

namespace models;
use PDO;

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
        $sql = "SELECT * FROM $this->table";
        $statement = $this->connexion->query($sql);
        $result = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row;
        }
        return $result;
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

    // Fonction pour calculer la quantité totale et les états du matériel
    public function calcul()
    {
        $totalQuantite = 0;
        $bon = 0;
        $mauvais = 0;
        $abime = 0;

        $sql = "SELECT quantite, etat FROM $this->table";
        $statement = $this->connexion->query($sql);

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $totalQuantite += $row['quantite'];

            switch ($row['etat']) {
                case 'BON':
                    $bon += $row['quantite'];
                    break;
                case 'MAUVAIS':
                    $mauvais += $row['quantite'];
                    break;
                case 'ABIME':
                    $abime += $row['quantite'];
                    break;
                default:
                    break;
            }
        }

        return [
            "totalQuantite" => $totalQuantite,
            "bon" => $bon,
            "mauvais" => $mauvais,
            "abime" => $abime
        ];
    }

    //Fonction recherche
    public function recherche($keyword, $etat = null)
{
    $sql = "SELECT * FROM $this->table WHERE design LIKE :keyword";
    $params = [':keyword' => "%$keyword%"];

    if ($etat !== null) {
        $sql .= " AND etat = :etat";
        $params[':etat'] = $etat;
    }

    $statement = $this->connexion->prepare($sql);
    $statement->execute($params);
    
    $result = [];
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $result[] = $row;
    }
    return $result;
}
}
