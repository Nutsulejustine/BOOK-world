<?php
include 'Database.php';
include 'Livre.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Créer une instance de Database et se connecter à la base de données
    $db = new Database();
    $pdo = $db->getConnection();

    // Créer une instance de Livre et récupérer les informations du livre
    $livre = new Livre($pdo);
    $livreInfo = $livre->getLivreById($id);
}

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les nouvelles informations du livre depuis le formulaire
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $date_publication = $_POST['date_publication'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Mettre à jour le livre dans la base de données
    $livre->mettreAJourLivre($id, $titre, $auteur, $genre, $date_publication, $description, $image);

    // Rediriger vers la page principale après la mise à jour
    header("Location: index.php");
    exit();
}
?>

<!-- Formulaire pour modifier les informations du livre -->
<form method="POST" action="modifier.php?id=<?= $id ?>">
    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($livreInfo['titre']) ?>" required>
    <label for="auteur">Auteur :</label>
    <input type="text" name="auteur" value="<?= htmlspecialchars($livreInfo['auteur']) ?>" required>
    <label for="genre">Genre :</label>
    <input type="text" name="genre" value="<?= htmlspecialchars($livreInfo['genre']) ?>" required>
    <label for="date_publication">Date de publication :</label>
    <input type="date" name="date_publication" value="<?= htmlspecialchars($livreInfo['date_publication']) ?>" required>
    <label for="description">Description :</label>
    <textarea name="description"><?= htmlspecialchars($livreInfo['description']) ?></textarea>
    <label for="image">Image :</label>
    <input type="text" name="image" value="<?= htmlspecialchars($livreInfo['image']) ?>">

    <button type="submit">Mettre à jour</button>
</form>
