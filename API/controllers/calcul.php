<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once("../config/Connexion.php");
require_once("../models/Materiel.php");

use config\Connexion;
use models\Materiel;

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // On instancie la base de données
    $database = new Connexion();
    $db = $database->getConnexion();

    // On instancie l'objet materiel
    $materiel = new Materiel($db);

    // Appel de la fonction calcul
    $result = $materiel->calcul();

    // Affichage du résultat
    echo json_encode($result);
} else {
    // Méthode non autorisée
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
