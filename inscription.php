<?php
// Code de connexion à la base de données et autres configurations...
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "connect";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérification de la connexion
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérification des données de formulaire soumises
if (isset($_POST['login']) && isset($_POST['mdp']) && isset($_POST['type'])) {
    $login = $_POST['login'];
    $motDePasse = $_POST['mdp'];
    $type = $_POST['type'];

    // Vérification si le login existe déjà dans la base de données
    $requeteVerification = "SELECT * FROM users WHERE login = '$login'";
    $resultatVerification = mysqli_query($connexion, $requeteVerification);

    if (mysqli_num_rows($resultatVerification) > 0) {
        // Le login existe déjà, afficher un message d'erreur
        echo "Ce login est déjà utilisé. Veuillez en choisir un autre.";
    } else {
        // Le login est unique, procéder à l'insertion des données dans la base de données
        $requeteInsertion = "INSERT INTO users (login, mdp, type) VALUES ('$login', '$motDePasse', '$type')";
        $resultatInsertion = mysqli_query($connexion, $requeteInsertion);

        // Vérification du résultat de l'insertion
        if ($resultatInsertion) {
            echo "Inscription réussie !";
        } else {
            echo "Erreur lors de l'inscription : " . mysqli_error($connexion);
        }
    }
}

// Code HTML pour le formulaire d'inscription...
?>
