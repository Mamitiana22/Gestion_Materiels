<?php

namespace config;

use PDO;

class Connexion
{
    public string $host = '127.0.0.1';
    public string $dbname = 'materials_management';
    public string $username = 'root';
    public string $password = '1234';

    public function __construct()
    {
    }

    // Connexion à la base de données
    public function getConnexion()
    {
        $conn = null;
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (\PDOException  $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
        return $conn;
    }
}
