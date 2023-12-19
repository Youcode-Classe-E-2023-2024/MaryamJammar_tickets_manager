<?php
// include_once('../model/TicketModel.php');

class TicketController
{
    private $ticketModel;

    public function __construct()
    {
        // Initialisez votre modèle Ticket ici
        $this->ticketModel = new TicketModel();
    }

    // Méthode pour traiter la soumission du formulaire de création de ticket
    public function createTicket()
    {
        // Récupérez les données du formulaire
        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $assignees = $_POST['assignees']; // Tableau d'IDs d'utilisateurs
        $tags = $_POST['tags']; // Tableau d'IDs de tags
        $commentId = $_POST['comment_id']; // Supposons que le champ du formulaire s'appelle comment_id
        $dateCreation = date('Y-m-d H:i:s'); // Utilisez la date actuelle lors de la création du ticket

        // Appelez la méthode du modèle pour créer le ticket en incluant comment_id et date_creation
        $ticketId = $this->ticketModel->createTicket($title, $description, $priority, $status, $commentId, $dateCreation);

        // Associez le ticket aux utilisateurs
        foreach ($assignees as $userId) {
            $this->ticketModel->assignTicketToUser($ticketId, $userId);
        }

        // Ajoutez les tags au ticket
        $this->ticketModel->addTagsToTicket($ticketId, $tags);

        // Redirigez vers la page des détails du ticket ou une autre page appropriée
        header("Location: tickets.php?id=$ticketId");
        exit();
    }

    // Méthode pour afficher le formulaire d'attribution de ticket à un utilisateur
    public function showAssignTicketForm($ticketId)
    {
        // Affichez ici votre formulaire d'attribution de ticket (HTML, Vue, etc.)
    }

    // Méthode pour traiter la soumission du formulaire d'attribution de ticket
    public function assignTicketToUser()
    {
        // Récupérez les données du formulaire
        $ticketId = $_POST['ticket_id'];
        $userId = $_POST['user_id'];

        // Appelez la méthode du modèle pour attribuer le ticket à l'utilisateur
        $this->ticketModel->assignTicketToUser($ticketId, $userId);

        // Redirigez vers la page des détails du ticket ou une autre page appropriée
        header("Location: tickets.php?id=$ticketId");
        exit();
    }

    // Méthode pour afficher le formulaire d'ajout de tags à un ticket
    public function showAddTagsForm($ticketId)
    {
        // Affichez ici votre formulaire d'ajout de tags (HTML, Vue, etc.)
    }

    // Méthode pour traiter la soumission du formulaire d'ajout de tags
    public function addTagsToTicket()
    {
        // Récupérez les données du formulaire
        $ticketId = $_POST['ticket_id'];
        $tags = $_POST['tags']; // Tableau d'IDs de tags

        // Appelez la méthode du modèle pour ajouter les tags au ticket
        $this->ticketModel->addTagsToTicket($ticketId, $tags);

        // Redirigez vers la page des détails du ticket ou une autre page appropriée
        header("Location: tickets.php?id=$ticketId");
        exit();
    }
}
