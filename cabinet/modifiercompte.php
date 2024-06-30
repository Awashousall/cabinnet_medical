<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modification de compte</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            /* Ajoutez l'image de fond */
            background-image: url('olp.jfif');
            background-size: cover; /* Ajustement de la taille de l'image */
            background-repeat: no-repeat; /* Empêche la répétition de l'image */
        }
    </style>
</head>
<body>
    <h2>Modification de compte</h2>
    <?php
    // Code de connexion à la base de données et autres configurations...
    $serveur = "localhost";
    $utilisateur = "root";
    $motDePasse = "";
    $baseDeDonnees = "connect";

    // Connexion à la base de données
    $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

    // Vérification de la connexion
    if (!$connexion) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    // Vérification si l'ID de l'utilisateur à modifier est présent dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Récupération des informations de l'utilisateur à modifier depuis la base de données
        $requeteSelection = "SELECT * FROM users WHERE id = '$id'";
        $resultatSelection = mysqli_query($connexion, $requeteSelection);

        if (mysqli_num_rows($resultatSelection) == 1) {
            $utilisateur = mysqli_fetch_assoc($resultatSelection);

            // Affichage du formulaire pré-rempli avec les informations de l'utilisateur
            echo '<form action="modifier_compte.php?id=' . $id . '" method="POST">';
            echo '<label for="login">Login :</label>';
            echo '<input type="email" id="login" name="login" value="' . $utilisateur['login'] . '" required><br><br>';
            echo '<label for="mot_de_passe">Nouveau mot de passe :</label>';
            echo '<input type="password" id="mdp" name="mdp" required><br><br>';
            echo '<label for="type">Type :</label>';
            echo '<select id="type" name="type">';
            echo '<option value="medecin" ' . ($utilisateur['type'] == 'medecin' ? 'selected' : '') . '>Médecin</option>';
            echo '<option value="receptionniste" ' . ($utilisateur['type'] == 'receptionniste' ? 'selected' : '') . '>Réceptionniste</option>';
            echo '<option value="admin" ' . ($utilisateur['type'] == 'admin' ? 'selected' : '') . '>Administrateur</option>';
            echo '<option value="patient" ' . ($utilisateur['type'] == 'patient' ? 'selected' : '') . '>Patient</option>';
            echo '</select>';
            echo '<input type="submit" value="Modifier">';
            echo '</form>';

            // Traitement du formulaire de modification
            if (isset($_POST['login'], $_POST['mdp'], $_POST['type'])) {
                $login = mysqli_real_escape_string($connexion, $_POST['login']);
                $motDePasse = mysqli_real_escape_string($connexion, $_POST['mdp']);
                $type = mysqli_real_escape_string($connexion, $_POST['type']);

                // Modification des informations de l'utilisateur dans la base de données
                $requeteModification = "UPDATE users SET login = '$login', mdp = '$motDePasse', type = '$type' WHERE id = '$id'";
                $resultatModification = mysqli_query($connexion, $requeteModification);

                // Vérification du résultat de la modification
                if ($resultatModification) {
                    echo "Modification réussie !";
                } else {
                    echo "Erreur lors de la modification : " . mysqli_error($connexion);
                }
            }
        } else {
            echo "Aucun utilisateur trouvé avec cet identifiant.";
        }
    } else {
        echo "Identifiant d'utilisateur non spécifié.";
    }
    ?>
</body>
</html>
