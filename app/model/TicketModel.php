<?php
// include('../controller/TicketController.php');

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
    public function createTicket($title, $description, $priority, $statut, $created_by)
    {

        // Requête SQL pour insérer un nouveau ticket
        $sql = "INSERT INTO tickets (title, description, priority, statut, date_creation, created_by) 
                VALUES (?, ?, ?, ?,NOW(), ?)";

        // Utilisation de requêtes préparées pour éviter les injections SQL
        try {
            // Prepare the statement
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                throw new Exception("Error preparing statement: " . $this->conn->error);
            }

            // Bind parameters
            $bindResult = $stmt->bind_param('ssssi', $title, $description, $priority, $statut, $created_by);

            if (!$bindResult) {
                throw new Exception("Error binding parameters: " . $stmt->error);
            }

            // Execute the statement
            $executeResult = $stmt->execute();

            if (!$executeResult) {
                // Check if the error is related to a foreign key constraint violation
                if ($stmt->errno == 1452) {
                    throw new Exception("Error executing statement: Foreign key constraint violation. The specified user does not exist.");
                } else {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
            }

            // Your existing code...

            echo "Record inserted successfully!";
            return mysqli_insert_id($this->conn);
        } catch (Exception $e) {
            // Handle the exception (log, display an error message, etc.)
            echo "Error: " . $e->getMessage();
        }
    }

    // Méthode pour récupérer tous les tickets
    public function getAllTickets()
    {
        $query = "SELECT * FROM tickets";
        $result = $this->conn->query($query);

        if ($result) {
            $tickets = [];
            while ($row = $result->fetch_assoc()) {
                $tickets[] = $row;
            }
            return $tickets;
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
        echo "test <br>";
        print_r($userId);
        try {
            $query = "INSERT INTO assignation (user_id, ticket_id) VALUES (?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("ii", $userId, $ticketId);

            // Execute the statement
            $executeResult = $stmt->execute();

            if (!$executeResult) {
                // Check if the error is related to a foreign key constraint violation
                if ($stmt->errno == 1452) {
                    throw new Exception("Error executing statement: Foreign key constraint violation. The specified user does not exist.");
                } else {
                    throw new Exception("Error executing statement: " . $stmt->error);
                }
            }

            // Your existing code...

            echo "Record inserted successfully!";
            return mysqli_insert_id($this->conn);
        } catch (Exception $e) {
            // Handle the exception (log, display an error message, etc.)
            echo "Error: " . $e->getMessage();
        }
    }

    // Méthode pour ajouter des tags à un ticket
    public function addTagsToTicket($ticketId, $tagIds)
    {
        // Préparez une requête d'insertion multiple pour chaque paire ticket_id, tag_id
        $query = "INSERT INTO tagg (ticket_id, tag_id) VALUES (?, ?)";
        $statement = $this->conn->prepare($query);

        $statement->bind_param("ii", $ticketId, $tagIds);
        $statement->execute();

        // Vérifiez si toutes les requêtes ont réussi (vous pouvez ajuster cela en fonction de vos besoins)
        return true;
    }

    // Méthode pour fermer la connexion à la base de données
    public function closeConnection()
    {
        $this->conn->close();
    }
}


// $ticketModel = new TicketModel();

// $tickets = $ticketModel->getAllTickets();


// Exemple d'utilisation du modèle
// $ticketModel = new TicketModel("localhost", "votre_nom_utilisateur", "votre_mot_de_passe", "nom_de_votre_base_de_donnees");
// $ticketModel->createTicket("Titre du ticket", "Description du ticket", "Haute", "En cours", 1, 123);
// $ticketModel->closeConnection();
