<?php
session_start();

// Code de connexion à la base de données et autres configurations...
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "connect";

// Connexion à la base de données
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

if (
    isset($_POST['NumDossier']) &&
    isset($_POST['nom_patient']) &&
    isset($_POST['prenom_patient']) &&
    isset($_POST['mail_patient']) &&
    isset($_POST['date']) &&
    isset($_POST['heure']) &&
    isset($_POST['poids']) &&
    isset($_POST['Temperature']) &&
    isset($_POST['Remarque']) &&
    isset($_POST['Bilan']) &&
    isset($_POST['Maladie']) &&
    isset($_POST['Symptomes']) &&
    isset($_POST['mail_medecin']) // Nouveau champ pour l'identifiant ou l'e-mail du médecin
) {
    extract($_POST);

    $sql = "INSERT INTO dossier (NumDossier, nom_patient, prenom_patient, mail_patient, date, heure, poids, Temperature, Remarque, Bilan, Maladie, Symptomes, mail_medecin) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($connexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssssssssssss", $NumDossier, $nom_patient, $prenom_patient, $mail_patient, $date, $heure, $poids, $Temperature, $Remarque, $Bilan, $Maladie, $Symptomes, $mail_medecin);

        if (mysqli_stmt_execute($stmt)) {
            echo "Dossier médical ajouté avec succès !";
        } else {
            echo "Erreur lors de l'ajout du dossier : " . mysqli_error($connexion);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur de préparation de la requête : " . mysqli_error($connexion);
    }
}
?>
