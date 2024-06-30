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
if (isset($_POST['login']) && isset($_POST['mdp'])) {
    $login = $_POST['login'];
    $motDePasse = $_POST['mdp'];

    // Requête SQL pour vérifier les informations d'identification de l'utilisateur
    $requete = "SELECT * FROM users WHERE login = '$login' AND mdp = '$motDePasse'";
    $resultat = mysqli_query($connexion, $requete);

    // Vérification du résultat de la requête
    if (mysqli_num_rows($resultat) == 1) {
        // L'utilisateur est authentifié avec succès
        $utilisateur = mysqli_fetch_assoc($resultat);
        
        // Redirection en fonction du type d'utilisateur
        if ($utilisateur['type'] == 'medecin') {
            header("Location: cabinet/medecin.html");
            exit();
        } elseif ($utilisateur['type'] == 'patient') {
            header("Location: cabinet/patient.html");
            exit();
        } elseif ($utilisateur['type'] == 'admin') {
            header("Location: cabinet/admin.html");
            exit();
        } elseif ($utilisateur['type'] == 'receptionniste') {
            header("Location: cabinet/receptionniste.html");
            exit();
        }
    } else {
        // Les informations d'identification sont invalides
        echo "Identifiants invalides !";
    }
}

// Code HTML pour le formulaire de connexion...
?>
