<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Rendez-vous</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6f2ff;
            color: #000;
            margin: 0;
            padding: 20px;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        h2 {
            font-size: 32px;
            color: blue;
            text-align: center;
            text-transform: uppercase;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #28a745;
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
        }
        .nav-link.blue,
        .navbar-brand.blue {
            color: blue !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Supprimer un Rendez-vous</h2>
        <?php
        // Vérifier si l'ID du rendez-vous à supprimer est passé en paramètre dans l'URL
        if (isset($_GET['id'])) {
            // Récupérer et échapper l'ID du rendez-vous
            $id_rendezvous = $_GET['id'];
            
            // Connexion à la base de données (à adapter selon vos paramètres)
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

            // Préparation de la requête SQL pour supprimer le rendez-vous
            $requete_suppression = "DELETE FROM rendezvous WHERE id = $id_rendezvous";

            // Exécution de la requête de suppression
            if (mysqli_query($connexion, $requete_suppression)) {
                echo '<div class="alert alert-success" role="alert">';
                echo "Rendez-vous supprimé avec succès !";
                echo '</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">';
                echo "Erreur lors de la suppression du rendez-vous : " . mysqli_error($connexion);
                echo '</div>';
            }

            // Fermeture de la connexion à la base de données
            mysqli_close($connexion);
        } else {
            echo '<div class="alert alert-warning" role="alert">';
            echo "Identifiant de rendez-vous non spécifié.";
            echo '</div>';
        }
        ?>
        <a href="liste_rendezvous.php" class="btn btn-primary">Retour à la liste des rendez-vous</a>
    </div>
</body>
</html>
