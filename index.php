<?php
// Inclure les fichiers nécessaires
include 'Database.php';
include 'Livre.php';

// Créer une instance de Database pour se connecter à la base de données
$db = new Database();
$pdo = $db->getConnection();

// Créer une instance de Livre
$livre = new Livre($pdo);

// Affichage des livres
$livres = $livre->afficherLivres();

// Ajouter un livre (exemple)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouter'])) {
    // Récupérer les informations du formulaire
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $date_publication = $_POST['date_publication'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Enregistrer le livre dans la base de données
    $livre->enregistrerLivre($titre, $auteur, $genre, $date_publication, $description, $image);
    header("Location: index.php"); // Rediriger après l'ajout
}

// Supprimer un livre
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $livre->supprimerLivre($id);
    header("Location: index.php"); // Rediriger après la suppression
}

// Mettre à jour un livre
if (isset($_GET['mettre_a_jour'])) {
    $id = $_GET['mettre_a_jour'];
    $livreData = $livre->getLivreById($id);
}

// Exemple d'affichage de formulaire de mise à jour
if (isset($_POST['mettre_a_jour'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $date_publication = $_POST['date_publication'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $livre->mettreAJourLivre($id, $titre, $auteur, $genre, $date_publication, $description, $image);
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFIER OU SUPPRIMER DES LIVRES</title>
    <link rel="stylesheet" href="style.css"> <!-- Vérifie que le chemin est correct -->
</head>

</head>
<body>

    

    <h2>Liste des livres</h2>
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Genre</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($livres as $livre): ?>
        <tr>
            <td><?= htmlspecialchars($livre['titre']) ?></td>
            <td><?= htmlspecialchars($livre['auteur']) ?></td>
            <td><?= htmlspecialchars($livre['genre']) ?></td>
            <td>
                <a href="index.php?supprimer=<?= $livre['id'] ?>">Supprimer</a>
                <a href="index.php?mettre_a_jour=<?= $livre['id'] ?>">Mettre à jour</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>


    <!-- Formulaire de mise à jour -->
    <?php if (isset($livreData)): ?>
    <h2>Mettre à jour le livre</h2>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $livreData['id'] ?>">
        <label>Titre:</label>
        <input type="text" name="titre" value="<?= $livreData['titre'] ?>" required><br>
        <label>Auteur:</label>
        <input type="text" name="auteur" value="<?= $livreData['auteur'] ?>" required><br>
        <label>Genre:</label>
        <input type="text" name="genre" value="<?= $livreData['genre'] ?>" required><br>
        <label>Date de publication:</label>
        <input type="date" name="date_publication" value="<?= $livreData['date_publication'] ?>" required><br>
        <label>Description:</label>
        <textarea name="description"><?= $livreData['description'] ?></textarea><br>
        <label>Image:</label>
        <input type="text" name="image" value="<?= $livreData['image'] ?>"><br>
        <button type="submit" name="mettre_a_jour">Mettre à jour</button>
    </form>
    <?php endif; ?>

</body>
</html>
