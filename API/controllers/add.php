<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once("../config/Connexion.php");
include_once("../models/Materiel.php");

use config\Connexion;
use models\Materiel;

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // On instancie la base de données
    $database = new connexion();
    $db = $database->getConnexion();

    // On instancie l'objet materiel
    $materiel = new Materiel($db);

    // On récupère les infos envoyées
    //$data = json_decode(file_get_contents("php://input"));
    $design = isset($_POST['design']) ? $_POST['design'] : null;
    $etat = isset($_POST['etat']) ? $_POST['etat'] : null;
    $quantite = isset($_POST['quantite']) ? $_POST['quantite'] : null;
    
    /*$design = $_POST['design'];
    $etat = $_POST['etat'];
    $quantite = $_POST['quantite'];*/

    if (!empty($design) && !empty($etat) && !empty($quantite)) {
        // On hydrate l'objet materiel
        $materiel->design = htmlspecialchars($design);
        $materiel->etat = htmlspecialchars($etat);
        $materiel->quantite = htmlspecialchars($quantite);

        $result = $materiel->add();
        if ($result) {
            http_response_code(201);
            echo json_encode(['message' => "materiel ajouté avec sucès"]);
        } else {
            http_response_code(503);
            echo json_encode(['message' => "L'ajout du materiel a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
