<?php
session_start();

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "connect";
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['mdp'])) {
        $login = $_POST['login'];
        $motDePasse = $_POST['mdp'];

        // Requête SQL pour vérifier les informations d'identification de l'utilisateur
        $requete = "SELECT * FROM users WHERE login = '$login' AND mdp = '$motDePasse'";
        $resultat = mysqli_query($connexion, $requete);

        if (mysqli_num_rows($resultat) == 1) {
            // L'utilisateur est authentifié avec succès
            $utilisateur = mysqli_fetch_assoc($resultat);
            
            // Stocker le login dans la session
            $_SESSION['user_login'] = $utilisateur['login'];
            $_SESSION['user_num_dossier'] = $num_dossier; 


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
            // Identifiants invalides, rediriger vers la page de connexion
            header("Location: connexion.html");
            exit();
        }
    }
}

?>
