<?php
include_once('../../config/Database.php');
// TicketModel.php

class TagModel {
    private $conn;
    public function __construct() {
        // Utilisation des constantes définies dans le fichier config.php
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Vérification de la connexion
        if ($this->conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $this->conn->connect_error);
        }
    }

    // Méthode pour créer un nouveau ticket dans la base de données
    public function createTag($tag) {
        // Requête SQL pour insérer un nouveau ticket
        $sql = "INSERT INTO tag (tag) 
                VALUES (?)";

        // Utilisation de requêtes préparées pour éviter les injections SQL
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $tag);

        // Exécution de la requête
        $stmt->execute();

        // Fermeture du statement
        $stmt->close();
    }

    // Méthode pour récupérer tous les tickets
    public function getAllTag() {
        $query = "SELECT * FROM tag";
        $result = $this->conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    public function getTagbyId($tag_id) {
        $query = "SELECT * FROM tag WHERE tag_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("i", $tag_id);
        $statement->execute();

        $result = $statement->get_result();

        if ($result) {
            return $result->fetch_assoc();
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    // Méthode pour fermer la connexion à la base de données
    public function closeConnection() {
        $this->conn->close();
    }
}

?>