<?php
// require_once("../../model/TicketModel.php");

// require_once("../../controller/TicketController.php");

// Passez les données à votre vue pour l'affichage
session_start();
class TicketController
{
    private $ticketModel;
    public function __construct() {
        $this->ticketModel = new TicketModel();
    }

    // Méthode pour traiter la soumission du formulaire de création de ticket
    public function createTicket()
    {

        if (isset($_POST["submit"])) {
            // Récupérez les données du formulaire
            $title = $_POST['title'];
            $description = $_POST['description'];
            $priority = $_POST['priority'];
            $statut = isset($_POST['statut']) ? $_POST['statut'] : 'Todo';
            $assignees = $_POST['assignTo']; // Tableau d'IDs d'utilisateurs
            $tags = $_POST['tag']; // Tableau d'IDs de tags

            // Appelez la méthode du modèle pour créer le ticket en incluant comment_id et date_creation
            $ticketId = $this->ticketModel->createTicket($title, $description, $priority, $statut, $_SESSION['user_id']);

            // Associez le ticket aux utilisateurs
            foreach ($assignees as $userId) {
                $this->ticketModel->assignTicketToUser($ticketId, $userId);
            }

            // Ajoutez les tags au ticket
            foreach ($tags as $tag) {
                $this->ticketModel->addTagsToTicket($ticketId, $tag);
            }

            echo "test";

            // Redirigez vers la page des détails du ticket ou une autre page appropriée
            header("Location: ../view/Ticket/tickets.php?id=$ticketId");
            exit();
        } else
            echo "madkhlch";
    }

    public function showTicket()
    {
        include_once('../../model/TicketModel.php');
        $ticketModel = new TicketModel();
        $tickets = $ticketModel->getAllTickets();

        // Passer les données à votre vue pour l'affichage
        return $tickets;
    }

    public function showTicketDetails($ticket_id) {
        // Récupérez les détails du ticket depuis le modèle
        $ticketDetails = $this->ticketModel->getTicketDetails($ticket_id);

        // Incluez la vue pour afficher les détails du ticket
        include 'views/ticketsDetails.php';
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

    public function filterTickets($filterType, $loggedInUserId) {
        // Utilisez le modèle pour obtenir les tickets filtrés
        $tickets = [];
    
        if ($filterType == 'all_tickets') {
            // Récupérer tous les tickets de la base de données
            $tickets = $this->ticketModel->getAllTickets();
        } elseif ($filterType == 'created_by_me') {
            // Récupérer les tickets créés par l'utilisateur connecté
            $tickets = $this->ticketModel->getFilteredTickets('created_by_me', $loggedInUserId);
        } elseif ($filterType == 'assigned_to_me') {
            // Récupérer les tickets assignés à l'utilisateur connecté
            $tickets = $this->ticketModel->getFilteredTickets('assigned_to_me', $loggedInUserId);
        }
    
        // Vous pouvez également implémenter d'autres filtres ici
    
        return $tickets;
    }
    
}

$ticket = new TicketController;

$ticket->createTicket();
