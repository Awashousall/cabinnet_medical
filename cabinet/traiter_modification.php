<?php
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "connect";
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numDossier = $_POST['NumDossier'];
    $nom_patient = $_POST['nom_patient'];
    $prenom_patient = $_POST['prenom_patient'];
    $date = $_POST['date'];
    $poids = $_POST['poids'];
    $temperature = $_POST['temperature'];
    $remarque = $_POST['remarque'];
    $bilan = $_POST['bilan'];
    $maladie = $_POST['maladie'];
    $symptomes = $_POST['symptomes'];
    $heure = $_POST['heure'];
    $mail_patient = $_POST['mail_patient'];
    $mail_medecin = $_POST['mail_medecin'];

    // Ajout de debugging pour vérifier les valeurs des variables
    echo "NumDossier: $numDossier<br>";
    echo "Nom Patient: $nom_patient<br>";
    echo "Prénom Patient: $prenom_patient<br>";
    echo "Date: $date<br>";
    echo "Poids: $poids<br>";
    echo "Temperature: $temperature<br>";
    echo "Remarque: $remarque<br>";
    echo "Bilan: $bilan<br>";
    echo "Maladie: $maladie<br>";
    echo "Symptomes: $symptomes<br>";
    echo "Heure: $heure<br>";
    echo "Mail Patient: $mail_patient<br>";
    echo "Mail Medecin: $mail_medecin<br>";

    $requete = "UPDATE dossier SET nom_patient = ?, prenom_patient = ?, date = ?, poids = ?, Temperature = ?, Remarque = ?, Bilan = ?, Maladie = ?, Symptomes = ?, heure = ?, mail_patient = ?, mail_medecin = ? WHERE NumDossier = ?";
    $stmt = mysqli_prepare($connexion, $requete);
    mysqli_stmt_bind_param($stmt, "ssssssssssssi", $nom_patient, $prenom_patient, $date, $poids, $temperature, $remarque, $bilan, $maladie, $symptomes, $heure, $mail_patient, $mail_medecin, $numDossier);

    if (mysqli_stmt_execute($stmt)) {
        echo "Dossier médical mis à jour avec succès.";
        header('Location: succes_modification.php');
        exit();
    } else {
        echo "Erreur lors de la mise à jour du dossier médical : " . mysqli_error($connexion);
    }
} else {
    echo "Méthode de requête non autorisée.";
}

mysqli_close($connexion);
?>
