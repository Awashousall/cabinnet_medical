<?php

// Démarrer la session
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header("Location: login.php"); // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Code de connexion à la base de données et autres configurations...
$serveur = "localhost";
$utilisateur_db = "root";
$motDePasse_db = "";
$baseDeDonnees = "connect";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur_db, $motDePasse_db, $baseDeDonnees);

// Vérification de la connexion
if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Vérification des données de formulaire soumises
if (isset($_POST['email']) && isset($_POST['numDossier'])) {
    $email = $_POST['email'];
    $numDossier = $_POST['numDossier'];

    // Vérification si l'e-mail saisi correspond à celui de l'utilisateur connecté
    if ($email == $_SESSION['login']) {
        // Requête SQL pour récupérer les dossiers médicaux correspondant à l'e-mail et au numéro de dossier donnés
        $requete = "SELECT * FROM dossierp WHERE mail_patient = '$email' AND NumDossier = '$numDossier'";
        $resultat = mysqli_query($connexion, $requete);

        // Vérification du résultat de la requête
        if ($resultat !== false) {
            if (mysqli_num_rows($resultat) > 0) {
                // Affichage des données
                while ($row = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . (isset($row['id']) ? $row['id'] : "") . "</td>";
                    echo "<td>" . $row['NumDossier'] . "</td>";
                    echo "<td>" . $row['idpatient'] . "</td>";
                    echo "<td>" . $row['nom_patient'] . "</td>";
                    echo "<td>" . $row['prenom_patient'] . "</td>";
                    echo "<td>" . $row['mail_patient'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['heure'] . "</td>";
                    echo "<td>" . $row['poids'] . "</td>";
                    echo "<td>" . $row['Temperature'] . "</td>";
                    echo "<td>" . $row['Remarque'] . "</td>";
                    echo "<td>" . $row['Bilan'] . "</td>";
                    echo "<td>" . $row['Maladie'] . "</td>";
                    echo "<td>" . $row['Symptomes'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14'>Aucun dossier médical trouvé pour ce numéro de dossier et cette adresse e-mail.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='14'>Erreur lors de l'exécution de la requête : " . mysqli_error($connexion) . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='14'>Vous n'êtes pas autorisé à consulter ce dossier médical.</td></tr>";
    }
}

// Fermeture de la connexion
mysqli_close($connexion);

// Code HTML pour le formulaire de consultation de dossier médical...
?>
