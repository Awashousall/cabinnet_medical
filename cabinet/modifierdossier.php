<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter Dossier Médical</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            background-color: #e6f2ff;
            color: #000;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1 {
            font-size: 32px;
            color: #007bff;
            text-align: center;
            text-transform: uppercase;
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #007bff;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 20px;
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
    <div class="bg-dark">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark">
                <img src="images/png-clipart-hospital-logo-clinic-health-care-physician-business-thumbnail.png" width="40" height="30" alt="Logo du site">
                <a class="navbar-brand blue" href="index.html">MediTeam</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link blue" href="index.html">Accueil</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link blue" href="contact.html">Contact</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link blue" href="connexion.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <div class="container">
        <h1>Modifier Dossier Médical</h1>
        <form method="post">
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Consulter</button>
        </form>
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Numéro de Dossier</th>
                    <th scope="col">Nom Patient</th>
                    <th scope="col">Prénom Patient</th>
                    <th scope="col">Mail Patient</th>
                    <th scope="col">Date</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Poids</th>
                    <th scope="col">Température</th>
                    <th scope="col">Remarque</th>
                    <th scope="col">Bilan</th>
                    <th scope="col">Maladie</th>
                    <th scope="col">Symptômes</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
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

                // Récupération de l'e-mail du patient ou du médecin depuis la méthode POST
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (isset($_POST['email'])) {
                        $email = $_POST['email'];

                        // Requête SQL pour récupérer les dossiers médicaux correspondant à l'e-mail du patient ou du médecin
                        $sql = "SELECT * FROM dossier WHERE mail_patient = '$email' OR mail_medecin = '$email'";
                        $resultat = mysqli_query($connexion, $sql);

                        if ($resultat !== false) {
                            if (mysqli_num_rows($resultat) > 0) {
                                // Affichage des données
                                while ($row = mysqli_fetch_assoc($resultat)) {
                                    echo "<tr>";
                                    echo "<td>" . (isset($row['NumDossier']) ? $row['NumDossier'] : "") . "</td>";
                                    echo "<td>" . $row['nom_patient'] . "</td>";
                                    echo "<td>" . $row['prenom_patient'] . "</td>";
                                    echo "<td>" . $row['mail_patient'] . "</td>";
                                    echo "<td>" . $row['date'] . "</td>";
                                    echo "<td>" . $row['heure'] . "</td>";
                                    echo "<td>" . $row['poids'] . "</td>";
                                    echo "<td>" . $row['Temperature'] . "</td>";
                                    echo "<td>" . $row['Remarque'] . "</td>";
                                    echo "<td>" . $row['Bilan'] . "</td>";
                                    echo "<td>" . $row['Maladie'] . "</td>";
                                    echo "<td>" . $row['Symptomes'] . "</td>";
                                    echo "<td><a href='modifier_dossier.php?id=" . $row['NumDossier'] . "' class='btn btn-primary'>Modifier</a></td>"; // Cellule pour le lien de modification
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='13'>Aucun dossier médical trouvé.</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='13'>Erreur lors de l'exécution de la requête : " . mysqli_error($connexion) . "</td></tr>";
                        }

                        // Fermeture de la connexion
                        mysqli_close($connexion);
                    } else {
                        echo "<tr><td colspan='13'>Aucune adresse e-mail spécifiée.</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts Bootstrap (ne pas modifier) -->
       <!-- Scripts Bootstrap (ne pas modifier) -->
       <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>

