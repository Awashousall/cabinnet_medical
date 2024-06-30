<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rendez-vous</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
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
        <h2>Liste des Rendez-vous</h2>
        <table>
            <thead>
                <tr>
                    <th>Numéro de Rendez-vous</th>
                    <th>Email du Médecin</th>
                    <th>Date</th>
                    <th>Nom du Patient</th>
                    <th>Prénom du Patient</th>
                    <th>Email du Patient</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
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

                // Préparation de la requête SQL pour récupérer tous les rendez-vous
                $requete = "SELECT * FROM rendezvous";

                // Exécution de la requête SQL
                $resultat = mysqli_query($connexion, $requete);

                // Vérification s'il y a des résultats
                if (mysqli_num_rows($resultat) > 0) {
                    // Parcourir les résultats et afficher chaque rendez-vous dans une ligne du tableau
                    while ($row = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        echo "<td>" . $row['num_rv'] . "</td>";
                        echo "<td>" . $row['email_medecin'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['nom_patient'] . "</td>";
                        echo "<td>" . $row['prenom_patient'] . "</td>";
                        echo "<td>" . $row['email_patient'] . "</td>";
                        echo '<td><a href="supprimer_rendezvous.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm">Supprimer</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo '<tr><td colspan="7">Aucun rendez-vous trouvé.</td></tr>';
                }

                // Fermeture de la connexion à la base de données
                mysqli_close($connexion);
                ?>
            </tbody>
        </table>
        <a href="ajouter_rendezvous.html" class="btn btn-primary">Ajouter un Rendez-vous</a>
    </div>
</body>
</html>
