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

    // On récupère les paramètres de la requête
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
    $etat = isset($_GET['etat']) ? $_GET['etat'] : null;

    // Vérifie si le mot-clé est fourni
    if ($keyword !== null) {
        // Appel de la fonction recherche
        $result = $materiel->recherche($keyword, $etat);

        // Vérifie si des résultats ont été trouvés
        if (!empty($result)) {
            // Affichage du résultat
            echo json_encode($result);
        } else {
            // Aucun résultat trouvé
            http_response_code(404);
            echo json_encode(['message' => "Aucun résultat trouvé pour le mot-clé '$keyword'"]);
        }
    } else {
        // Paramètre manquant
        http_response_code(400);
        echo json_encode(['message' => "Le paramètre 'keyword' est requis"]);
    }
} else {
    // Méthode non autorisée
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
