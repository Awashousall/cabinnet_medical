<?php
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

// Récupération de l'e-mail du patient depuis la méthode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['numDossier'], $_POST['email'])) {
        $numDossier = $_POST['numDossier'];
        $email = $_POST['email'];

        // Requête SQL pour vérifier si le numéro de dossier correspond à l'e-mail du patient
        $sql = "SELECT * FROM dossier WHERE NumDossier = '$numDossier' AND mail_patient = '$email'";
        $resultat = mysqli_query($connexion, $sql);

        if ($resultat !== false) {
            if (mysqli_num_rows($resultat) > 0) {
                // Affichage des données
                while ($row = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    echo "<td>" . $row['NumDossier'] . "</td>";
                    echo "<td>" . $row['nom_patient'] . "</td>";
                    echo "<td>" . $row['prenom_patient'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['poids'] . "</td>";
                    echo "<td>" . $row['Temperature'] . "</td>";
                    echo "<td>" . $row['Remarque'] . "</td>";
                    echo "<td>" . $row['Bilan'] . "</td>";
                    echo "<td>" . $row['Maladie'] . "</td>";
                    echo "<td>" . $row['Symptomes'] . "</td>";
                    echo "<td>" . $row['heure'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>Aucun dossier médical trouvé pour ce numéro de dossier et cet e-mail.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='11'>Erreur lors de l'exécution de la requête : " . mysqli_error($connexion) . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='11'>Veuillez saisir le numéro de dossier et l'e-mail du patient.</td></tr>";
    }

    // Fermeture de la connexion
    mysqli_close($connexion);
}
?>
