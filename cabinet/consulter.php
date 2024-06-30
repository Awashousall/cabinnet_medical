<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header('Location: login.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si l'utilisateur est un médecin
if ($_SESSION['login']['type'] !== 'medecin') {
    echo "Accès non autorisé."; // Afficher un message d'erreur si l'utilisateur n'est pas un médecin
    exit();
}

// Récupérer l'identifiant du médecin connecté
$idMedecin = $_SESSION['login']['id'];

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'connect');

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué: " . $conn->connect_error);
}

// Préparer la requête SQL
$sql = "SELECT * FROM dossier WHERE idMed = ?";

// Préparer et exécuter la requête avec une déclaration préparée
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $idMedecin);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter Dossiers Médicaux</title>
    <!-- Mettez vos liens vers les CSS et les bibliothèques JS ici -->
</head>

<body>
    <h1>Dossiers Médicaux</h1>
    <table>
        <thead>
            <tr>
                <th>NumDossier</th>
                <th>Date</th>
                <th>Poids</th>
                <!-- Ajoutez d'autres en-têtes si nécessaire -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['NumDossier']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['poids']; ?></td>
                    <!-- Ajoutez d'autres colonnes si nécessaire -->
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <!-- Ajoutez d'autres éléments HTML si nécessaire -->
</body>

</html>

<?php
// Fermer la déclaration préparée et la connexion à la base de données
$stmt->close();
$conn->close();
?>
