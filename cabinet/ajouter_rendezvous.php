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

// Vérification si les données du formulaire sont soumises
if (isset($_POST['num_rv'], $_POST['nom_medecin'], $_POST['date'], $_POST['nom_patient'])) {
    $num_rv = mysqli_real_escape_string($connexion, $_POST['num_rv']);
    $nom_medecin = mysqli_real_escape_string($connexion, $_POST['nom_medecin']);
    $date = mysqli_real_escape_string($connexion, $_POST['date']);
    $nom_patient = mysqli_real_escape_string($connexion, $_POST['nom_patient']);

    // Requête SQL pour insérer les données du rendez-vous
    $requeteInsertion = "INSERT INTO rendezvous (NumRv, NomMedecin, Date, Nom_patient) VALUES ('$num_rv', '$nom_medecin', '$date', '$nom_patient')";
    $resultatInsertion = mysqli_query($connexion, $requeteInsertion);

    // Vérification du résultat de l'insertion
    if ($resultatInsertion) {
        echo "Rendez-vous ajouté avec succès !";
    } else {
        echo "Erreur lors de l'ajout du rendez-vous : " . mysqli_error($connexion);
    }
} else {
    echo "Veuillez remplir tous les champs du formulaire.";
}

// Fermer la connexion à la base de données
mysqli_close($connexion);
?>
