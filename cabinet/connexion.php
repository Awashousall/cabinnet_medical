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
        $login = mysqli_real_escape_string($connexion, $_POST['login']);
        $motDePasse = mysqli_real_escape_string($connexion, $_POST['mdp']);

        // Requête SQL pour vérifier les informations d'identification de l'utilisateur
        $requete = "SELECT * FROM users WHERE login = '$login' AND mdp = '$motDePasse'";
        $resultat = mysqli_query($connexion, $requete);

        if (mysqli_num_rows($resultat) == 1) {
            // L'utilisateur est authentifié avec succès
            $utilisateur = mysqli_fetch_assoc($resultat);
            
            // Stocker le login dans la session
            $_SESSION['user_login'] = $utilisateur['login'];
            // Stocker d'autres informations de l'utilisateur dans la session si nécessaire
            $_SESSION['user_type'] = $utilisateur['type']; // exemple: type de l'utilisateur
            
            // Redirection en fonction du type d'utilisateur
            switch ($utilisateur['type']) {
                case 'medecin':
                    header("Location: cabinet/medecin.html");
                    break;
                case 'patient':
                    header("Location: cabinet/patient.html");
                    break;
                case 'admin':
                    header("Location: cabinet/admin.html");
                    break;
                case 'receptionniste':
                    header("Location: cabinet/receptionniste.html");
                    break;
                default:
                    // Redirection par défaut
                    header("Location: index.html");
                    break;
            }
            exit();
        } else {
            // Identifiants invalides, rediriger vers la page de connexion avec un message d'erreur
            header("Location: connexion.html?erreur=identifiants_invalides");
            exit();
        }
    }
}
?>
