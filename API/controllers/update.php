<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: PUT");

use config\Connexion;
use models\Materiel;

if ($_SERVER['REQUEST_METHOD'] === "PUT") {
    // On instancie la base de données
    $database = new connexion();
    $db = $database->getConnexion();

    // On instancie l'objet etudiant
    $materiel = new Materiel($db);

    // On récupère les infos envoyées
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->numMateriel) && !empty($data->design) && !empty($data->etat) && !empty($data->quantite)) {
        // On hydrate l'objet etudiant
        $materiel->numMateriel = intval($data->numMateriel);
        $materiel->design = htmlspecialchars($data->design);
        $materiel->etat = htmlspecialchars($data->etat);
        $materiel->quantite = htmlspecialchars($data->quantite);

        $result = $materiel->update();
        if ($result) {
            http_response_code(201);
            echo json_encode([$materiel->fetchMaterielUpdated()]);

        } else {
            http_response_code(503);
            echo json_encode(['message' => "La modification du materiel a échoué"]);
        }
    } else {
        echo json_encode(['message' => "Les données ne sont au complet"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
