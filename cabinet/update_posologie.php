<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "connect";
$connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

if (!$connexion) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Sélectionner les lignes où les médicaments et les posologies sont dans la même colonne
$sql_select = "SELECT id_ordonnance, medicaments FROM ordonnance WHERE posologie = '' OR posologie IS NULL";
$result = mysqli_query($connexion, $sql_select);

if ($result !== false && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id_ordonnance = $row['id_ordonnance'];
        $medicaments = $row['medicaments'];

        // Séparer les médicaments et les posologies
        $medicaments_array = explode(', ', $medicaments);
        $medicaments_clean = [];
        $posologie_clean = [];

        foreach ($medicaments_array as $medicament) {
            $parts = explode(':', $medicament, 2);
            if (count($parts) == 2) {
                $medicaments_clean[] = trim($parts[0]);
                $posologie_clean[] = trim($parts[1]);
            } else {
                $medicaments_clean[] = trim($parts[0]);
            }
        }

        $medicaments_clean_str = implode(', ', $medicaments_clean);
        $posologie_clean_str = implode(', ', $posologie_clean);

        // Mettre à jour les données dans la base de données
        $sql_update = "UPDATE ordonnance SET medicaments = '$medicaments_clean_str', posologie = '$posologie_clean_str' WHERE id_ordonnance = $id_ordonnance";
        mysqli_query($connexion, $sql_update);
    }
}

mysqli_close($connexion);
?>
