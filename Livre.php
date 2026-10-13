<?php
class Livre {
    private $pdo;

    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour enregistrer un livre
    public function enregistrerLivre($titre, $auteur, $genre, $date_publication, $description, $image) {
        try {
            $sql = "INSERT INTO livres (titre, auteur, genre, date_publication, description, image) 
                    VALUES (:titre, :auteur, :genre, :date_publication, :description, :image)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':date_publication', $date_publication);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Erreur de base de données: " . $e->getMessage();
            return false;
        }
    }

    // Méthode pour afficher tous les livres
    public function afficherLivres() {
        try {
            $sql = "SELECT * FROM livres";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des livres : " . $e->getMessage();
            return [];
        }
    }

    // Méthode pour supprimer un livre par ID
    public function supprimerLivre($id) {
        try {
            $query = "DELETE FROM livres WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression du livre : " . $e->getMessage();
        }
    }

    // Méthode pour récupérer un livre par ID
    public function getLivreById($id) {
        try {
            $query = "SELECT * FROM livres WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération du livre : " . $e->getMessage();
            return null;
        }
    }

    // Méthode pour mettre à jour un livre
    public function mettreAJourLivre($id, $titre, $auteur, $genre, $date_publication, $description, $image) {
        try {
            $query = "UPDATE livres SET titre = :titre, auteur = :auteur, genre = :genre, 
                      date_publication = :date_publication, description = :description, image = :image 
                      WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':auteur', $auteur);
            $stmt->bindParam(':genre', $genre);
            $stmt->bindParam(':date_publication', $date_publication);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de la mise à jour du livre : " . $e->getMessage();
        }
    }
}
?>
