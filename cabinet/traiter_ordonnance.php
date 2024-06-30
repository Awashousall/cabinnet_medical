<?php
// Connexion à la base de données
$servername = "localhost"; // Remplacez par votre serveur
$username = "root"; // Remplacez par votre nom d'utilisateur
$password = ""; // Remplacez par votre mot de passe
$dbname = "connect"; // Remplacez par le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Récupérer les données du formulaire
$nom_patient = $_POST['nom_patient'];
$prenom_patient = $_POST['prenom_patient'];
$id_dossier = $_POST['id_dossier'];
$medicaments = isset($_POST['medicament']) ? $_POST['medicament'] : array(); // Correction de la clé
$autres_medicaments = isset($_POST['autre_medicament']) ? $_POST['autre_medicament'] : '';
$posologies = isset($_POST['posologie']) ? $_POST['posologie'] : array(); // Correction de la clé
$email_patient = $_POST['email_patient'];
$email_medecin = $_POST['email_medecin'];
$date_creation = $_POST['date_creation'];

// Vérifier et traiter les autres médicaments
if (!empty($autres_medicaments)) {
    if (!is_array($autres_medicaments)) {
        $autres_medicaments = array($autres_medicaments);
    }
    $medicaments = array_merge($medicaments, $autres_medicaments);
}

// Vérifier et traiter les posologies
if (!empty($posologies)) {
    if (!is_array($posologies)) {
        $posologies = array($posologies);
    }
    $medicaments = array_map(function($medicament, $posologie) {
        return $medicament . ': ' . $posologie;
    }, $medicaments, $posologies);
}

// Convertir les tableaux en chaînes de caractères pour l'insertion
$medicaments_str = implode(", ", $medicaments);

// Préparer et exécuter la requête d'insertion
$sql = "INSERT INTO ordonnance (nom_patient, prenom_patient, id_dossier, medicaments, email_patient, email_medecin, date_creation)
VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $nom_patient, $prenom_patient, $id_dossier, $medicaments_str, $email_patient, $email_medecin, $date_creation);

if ($stmt->execute()) {
    echo "Ordonnance ajoutée avec succès";
} else {
    echo "Erreur : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
