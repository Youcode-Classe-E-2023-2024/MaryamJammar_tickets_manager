<?php
require_once '../model/UserModel.php';
include_once('../../config/Database.php');


// Initialisez votre base de données (vous devrez avoir un code pour cela)
$db = new Database();
$dbConnection = $db->connect();

// Initialisez le contrôleur
$userController = new UserController($dbConnection);

// Traitez les données du formulaire (postées par l'utilisateur)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $userController->registerUser($_POST);
    } elseif (isset($_POST['login'])) {
        $userController->loginUser($_POST);
    }
}

class UserController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new UserModel($db);
    }

    public function registerUser($data)
    {
        // Traitez les données de la vue ici
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $profile = $_POST['profile'];
        $email = $_POST['email'];
        $password = $_POST['pwd'];
        $confirmPassword = $_POST['cpass'];

        // Vérifiez si les mots de passe correspondent
        if ($password === $confirmPassword) {
            // Appelez la méthode d'inscription du modèle
            $result = $this->model->registerUser($firstname, $lastname, $profile, $email, $password);

            // Vous pouvez rediriger l'utilisateur en fonction du résultat
            if ($result) {
                header('Location: ../view/User/login.php'); // Redirigez vers la page de connexion après l'inscription réussie
                exit();
            } else {
                echo "Registration failed. Please try again.";
            }
        } else {
            echo "Passwords do not match.";
        }
    }

    public function loginUser($data)
    {
        // Traitez les données de la vue ici
        $email = $_POST['email'];
        $password = $_POST['pwd']; // Correction ici

        // Appelez la méthode de connexion du modèle
        $result = $this->model->loginUser($email, $password);

        // Vous pouvez rediriger l'utilisateur en fonction du résultat
        if ($result) {
            header('Location: ../view/Ticket/tickets.php'); // Redirigez vers la page du tableau de bord après la connexion réussie
            exit();
        } else {
            echo "Login failed. Please check your profile and password.";
        }
    } 

}
?>
