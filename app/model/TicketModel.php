<?php
include_once('../../config/Database.php');
// TicketModel.php

class TicketModel
{
    private $conn;
    public function __construct()
    {
        // Utilisation des constantes définies dans le fichier config.php
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        // Vérification de la connexion
        if ($this->conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $this->conn->connect_error);
        }
    }

    // Méthode pour créer un nouveau ticket dans la base de données
    public function createTicket($title, $description, $priority, $statut, $createdBy, $commentId)
    {

        // Requête SQL pour insérer un nouveau ticket
        $sql = "INSERT INTO tickets (title, description, priority, statut, created_by, comment_id, date_creation) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";

        // Utilisation de requêtes préparées pour éviter les injections SQL
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssii', $title, $description, $priority, $statut, $createdBy, $commentId);

        // Exécution de la requête
        $stmt->execute();

        // Fermeture du statement
        $stmt->close();
    }

    // Méthode pour récupérer tous les tickets
    public function getAllTickets()
    {
        $query = "SELECT * FROM tickets";
        $result = $this->conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    // Méthode pour récupérer les détails d'un ticket spécifique
    public function getTicketDetails($ticketId)
    {
        $query = "SELECT * FROM tickets WHERE ticket_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("i", $ticketId);
        $statement->execute();

        $result = $statement->get_result();

        if ($result) {
            return $result->fetch_assoc();
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    // Méthode pour mettre à jour les détails d'un ticket
    public function updateTicket($ticketId, $title, $description, $priority, $status)
    {
        $query = "UPDATE tickets SET title = ?, description = ?, priority = ?, statut = ? WHERE ticket_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("ssssi", $title, $description, $priority, $status, $ticketId);

        if ($statement->execute()) {
            return true;
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    public function deleteTicket($ticketId)
    {
        $query = "DELETE FROM tickets WHERE ticket_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("i", $ticketId);

        if ($statement->execute()) {
            return true;
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    // Méthode pour attribuer un ticket à un utilisateur
    public function assignTicketToUser($ticketId, $userId)
    {
        $query = "INSERT INTO assignation (user_id, ticket_id) VALUES (?, ?)";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("ii", $userId, $ticketId);

        if ($statement->execute()) {
            return true;
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    // Méthode pour ajouter des tags à un ticket
    public function addTagsToTicket($ticketId, $tagIds)
    {
        // Préparez une requête d'insertion multiple pour chaque paire ticket_id, tag_id
        $query = "INSERT INTO tagg (ticket_id, tag_id) VALUES (?, ?)";
        $statement = $this->conn->prepare($query);

        // Boucle sur les tagIds et exécutez la requête pour chaque paire
        foreach ($tagIds as $tagId) {
            $statement->bind_param("ii", $ticketId, $tagId);
            $statement->execute();
        }

        // Vérifiez si toutes les requêtes ont réussi (vous pouvez ajuster cela en fonction de vos besoins)
        return true;
    }

    // Méthode pour fermer la connexion à la base de données
    public function closeConnection()
    {
        $this->conn->close();
    }
}

// Exemple d'utilisation du modèle
// $ticketModel = new TicketModel("localhost", "votre_nom_utilisateur", "votre_mot_de_passe", "nom_de_votre_base_de_donnees");
// $ticketModel->createTicket("Titre du ticket", "Description du ticket", "Haute", "En cours", 1, 123);
// $ticketModel->closeConnection();

// Exemple d'utilisation du modèle
// $ticketModel = new TicketModel();
// $ticketModel->createTicket("Titre du ticket", "Description du ticket", "Haute", "En cours", 1, 123);
// $ticketModel->closeConnection();
