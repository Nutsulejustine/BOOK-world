<?php
include 'Database.php';
include 'Livre.php';

$db = new Database();
$pdo = $db->getConnection();
$livre = new Livre($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $genre = $_POST['genre'];
    $date_publication = $_POST['date_publication'];
    $description = $_POST['description'];
    $image = null; // Default to NULL in case no file is uploaded

    // Check if the image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = __DIR__ . '/uploads/';

        // Create the 'uploads' directory if it doesn't exist
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory with read/write permissions
        }

        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        // Check if the file is a valid image
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = $_FILES['image']['type'];
        if (in_array($fileType, $allowedTypes) && move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // Save the relative path to the image in the $image variable
            $image = 'uploads/' . $imageName;
        } else {
            echo "Error: Invalid file type or upload failed.<br>";
            exit;
        }
    }

    // Insert data into the database
    if ($livre->enregistrerLivre($titre, $auteur, $genre, $date_publication, $description, $image)) {
        header("Location: afficherlivre.php");
    } else {
        echo "Error: Failed to save book.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enregistrer un livre</title>
    <style>
        /* Style de base */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Conteneur principal */
form {
    background-color: #ffffff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    margin: 20px auto; /* Centré horizontalement avec un espace en haut */
}

/* Titre */
h1 {
    text-align: center; /* Centré horizontalement */
    color: #333;
    margin-bottom: 10px; /* Réduction de l'espace en dessous */
}

/* Labels */
label {
    font-weight: bold;
    color: #555;
    display: block;
    margin-bottom: 5px;
}

/* Champs de formulaire */
input[type="text"],
input[type="date"],
textarea,
input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 14px;
    box-sizing: border-box;
}

textarea {
    resize: none;
}

/* Bouton */
button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 15px;
    text-transform: uppercase;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px

</style>
</head>
<body>
    <h1>Enregistrer un livre</h1>
    <form action="livreEnregistrement.php" method="POST" enctype="multipart/form-data">
        <label for="titre">Titre :</label>
        <input type="text" id="titre" name="titre" required><br><br>

        <label for="auteur">Auteur :</label>
        <input type="text" id="auteur" name="auteur" required><br><br>

        <label for="genre">Genre :</label>
        <input type="text" id="genre" name="genre"><br><br>

        <label for="date_publication">Date de publication :</label>
        <input type="date" id="date_publication" name="date_publication"><br><br>

        <label for="description">Description :</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <label for="image">Image de couverture :</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>

