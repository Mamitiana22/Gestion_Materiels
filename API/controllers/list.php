<?php
namespace controllers;

header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: GET");

require_once("../config/Connexion.php");
include_once("../models/Materiel.php");

use config\Connexion;
use models\Materiel;

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // On instancie la base de données
    $database = new Connexion();
    $db = $database->getConnexion();

    // On instancie l'objet materiel
    $materiel = new Materiel($db);

    // Récupération des données
    $data = $materiel->listMateriel();

    if (!empty($data)) {
        // on renvoie ses données sous format json
        http_response_code(200);
        echo json_encode($data);
    } else {
        // Si aucune donnée n'est trouvée
        http_response_code(404);
        echo json_encode(["message" => "Aucune donnée à renvoyer"]);
    }
} else {
    // Si la méthode n'est pas autorisée
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
