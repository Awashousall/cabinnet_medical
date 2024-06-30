<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "connect";

$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérification de la connexion
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérification si l'identifiant de l'utilisateur à supprimer est présent dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête SQL pour supprimer l'utilisateur
    $requeteSuppression = "DELETE FROM users WHERE id = $id";
    $resultatSuppression = mysqli_query($connexion, $requeteSuppression);

    // Vérification du résultat de la suppression
    if ($resultatSuppression) {
        echo "L'utilisateur a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression de l'utilisateur : " . mysqli_error($connexion);
    }
} else {
    echo "Identifiant d'utilisateur non spécifié.";
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
