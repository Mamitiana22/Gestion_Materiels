<?php
// Les entêtes requises
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset= UTF-8");
header("Access-Control-Allow-Methods: GET");

use config\Connexion;
use models\Materiel;

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    // On instancie la base de données
    $database = new connexion();
    $db = $database->getConnexion();

    // On instancie l'objet materiel
    $materiel = new Materiel($db);

    // Récupération des données
    $statement = $materiel->listMateriel();

    if ($statement->rowCount() > 0) {
        $data = [];

        $data[] = $statement->fetchAll();


        // on renvoie ses données sous format json
        http_response_code(200);
        echo json_encode($data);
    } else {
        echo json_encode(["message" => "Aucune données à renvoyer"]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => "La méthode n'est pas autorisée"]);
}
