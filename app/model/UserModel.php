<?php

require_once '../../config/Database.php';

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // ... (Autres fonctions du modèle)

    public function registerUser($firstname, $lastname, $profile, $email, $password)
    {
        $fullname = $firstname . ' ' . $lastname;
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if ($this->isEmailUnique($email) && $this->isProfileUnique($profile)) {
            $stmt = $this->db->prepare("INSERT INTO users (`profile`, `fullname`, `email`, `pwd`) VALUES (?, ?, ?, ?)");
            
            if ($stmt) {
                $stmt->bind_param("ssss", $profile, $fullname, $email, $hashedPassword);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    return true;
                } else {
                    echo "Erreur d'exécution de la requête SQL: " . $stmt->error;
                    return false;
                }
            } else {
                echo "Erreur de préparation de la requête SQL: " . $this->db->error;
                return false;
            }
        } else {
            return false;
        }
    }


    public function loginUser($profile, $password)
    {
        // Récupérez les informations de l'utilisateur à partir de la base de données
        $stmt = $this->db->prepare("SELECT * FROM users WHERE profile = ?");
        $stmt->bind_param("s", $profile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Vérifiez le mot de passe
            if (password_verify($password, $user['pwd'])) {
                // Commencez la session et stockez les informations de l'utilisateur
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['profile'] = $user['profile'];

                return true; // Connexion réussie
            }
        }

        return false; // Connexion échouée
    }

    private function isEmailUnique($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows === 0;
    }

    private function isprofileUnique($profile)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE profile = ?");

        // Vérifiez s'il y a des erreurs avec la préparation de la requête
        

        $stmt->bind_param("s", $profile);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows === 0;
    }
}
