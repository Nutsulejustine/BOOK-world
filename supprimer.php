<?php
include 'Database.php';
include 'Livre.php';

// Vérifier si l'ID du livre est passé dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance de la classe Database et se connecter à la base de données
    $db = new Database();
    $pdo = $db->getConnection();

    // Créer une instance de la classe Livre et supprimer le livre
    $livre = new Livre($pdo);
    $livre->supprimerLivre($id);

    // Rediriger l'utilisateur vers la page principale après la suppression
    header("Location: index.php");
    exit();
}
?>
