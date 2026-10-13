<?php
include 'Database.php';
include 'Livre.php';

// Créer une instance de Database pour se connecter à la base de données
$db = new Database();
$pdo = $db->getConnection();

// Créer une instance de Livre
$livre = new Livre($pdo);

// Récupérer tous les livres
$livres = $livre->afficherLivres();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque en ligne</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        h1 {
            color: #333;
            margin: 20px 0;
        }
        .library-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            padding: 20px;
            width: 80%;
        }
        .book-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .book-card:hover {
            transform: translateY(-10px);
        }
        .book-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .book-info {
            padding: 15px;
        }
        .book-info h3 {
            font-size: 1.2em;
            margin: 0 0 10px;
        }
        .book-info p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #555;
        }
        .book-info .description {
            font-size: 0.8em;
            color: #666;
        }
    </style>
</head>
<body>

    <h1>Bienvenue dans notre bibliothèque en ligne</h1>
    
    <div class="library-container">
        <?php foreach ($livres as $livre): ?>
            <?php 
            // Vérifie si le chemin de l'image est valide, sinon utilise une image par défaut
            $imagePath = !empty($livre['image']) && file_exists($livre['image']) ? htmlspecialchars($livre['image']) : 'uploads/default.jpg';
            ?>
            <div class="book-card">
                <img src="<?= $imagePath ?>" alt="Image de couverture de <?= htmlspecialchars($livre['titre'] ?? 'livre inconnu') ?>">
                <div class="book-info">
                    <h3><?= htmlspecialchars($livre['titre'] ?? 'Titre inconnu') ?></h3>
                    <p><strong>Auteur :</strong> <?= htmlspecialchars($livre['auteur'] ?? 'Auteur inconnu') ?></p>
                    <p><strong>Genre :</strong> <?= htmlspecialchars($livre['genre'] ?? 'Genre inconnu') ?></p>
                    <p><strong>Date de publication :</strong> <?= htmlspecialchars($livre['date_publication'] ?? 'Date inconnue') ?></p>
                    <p class="description"><?= htmlspecialchars($livre['description'] ?? 'Aucune description disponible') ?></p>
                    <a href="supprimer.php?id=<?= $livre['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?');">Supprimer</a>
                    <a href="modifier.php?id=<?= $livre['id'] ?>">Mettre à jour</a>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
