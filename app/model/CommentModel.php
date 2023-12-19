<?php
include_once('../../config/Database.php');

class CommentModel {
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
    public function createComment($content, $user_id, $ticket_id, $dateC) {
        // Requête SQL pour insérer un nouveau ticket
        $sql = "INSERT INTO comments (content, user_id, ticket_id, date_comment) 
                VALUES (?, ?, ?, NOW())";

        // Utilisation de requêtes préparées pour éviter les injections SQL
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sii', $content, $user_id, $ticket_id, $dateC);

        // Exécution de la requête
        $stmt->execute();

        // Fermeture du statement
        $stmt->close();
    }

    // Méthode pour récupérer tous les tickets
    public function getAllComments() {
        $query = "SELECT * FROM comments";
        $result = $this->conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    // Méthode pour récupérer les détails d'un ticket spécifique
    public function getCommentById($comment_id) {
        $query = "SELECT * FROM comments WHERE comment_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("i", $comment_id);
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
    public function updateComment($comment_id, $content, $user_id, $ticket_id) {
        $query = "UPDATE comments SET content = ?, user_id = ?, ticket_id = ? WHERE comment_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("sii", $content, $user_id, $ticket_id, $comment_id);

        if ($statement->execute()) {
            return true;
        } else {
            // Gestion des erreurs, vous pouvez personnaliser cette partie en fonction de vos besoins
            return false;
        }
    }

    public function deleteTicket($comment_id) {
        $query = "DELETE FROM comments WHERE comment_id = ?";
        $statement = $this->conn->prepare($query);
        $statement->bind_param("i", $comment_id);

        if ($statement->execute()) {
            return true;
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