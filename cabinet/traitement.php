<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Réussie</title>
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
        .table {
            margin-top: 20px;
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
        <h2>Recherche d'Ordonnances</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="email">Email du Patient :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="id_dossier">ID Dossier :</label>
                <input type="text" class="form-control" id="id_dossier" name="id_dossier" required>
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
        </form>

        <?php
        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données saisies par l'utilisateur
            $email = $_POST['email'];
            $id_dossier = $_POST['id_dossier'];

            // Liste des adresses e-mail autorisées
            $allowed_emails = array('absa@gmail.com', 'awasall2@gmail.com'); // Mettez ici les adresses autorisées

            // Vérification si l'adresse e-mail saisie est autorisée
            if (!in_array($email, $allowed_emails)) {
                echo "<p class='mt-3'>Vous n'êtes pas autorisé à consulter ce dossier médical.</p>";
            } else {
                // Connexion à la base de données
                $serveur = "localhost";
                $utilisateur = "root";
                $motDePasse = "";
                $baseDeDonnees = "connect";

                $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

                if (!$connexion) {
                    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
                }

                // Préparation des données pour éviter les injections SQL
                $email = mysqli_real_escape_string($connexion, $email);
                $id_dossier = mysqli_real_escape_string($connexion, $id_dossier);

                // Requête SQL pour récupérer les ordonnances correspondant à l'e-mail du patient et l'id_dossier
                $sql = "SELECT * FROM ordonnance WHERE email_patient = '$email' AND id_dossier = '$id_dossier'";
                $resultat = mysqli_query($connexion, $sql);

                if ($resultat !== false) {
                    if (mysqli_num_rows($resultat) > 0) {
                        // Affichage des données dans un tableau Bootstrap
                        echo "<h3 class='mt-4'>Liste des Ordonnances</h3>";
                        echo "<div class='table-responsive'>";
                        echo "<table class='table table-striped'>";
                        echo "<thead class='thead-light'>";
                        echo "<tr><th>ID Ordonnance</th><th>Nom Patient</th><th>Prénom Patient</th><th>ID Dossier</th><th>Médicaments</th><th>Email Patient</th><th>Email Médecin</th><th>Date Création</th></tr></thead>";
                        echo "<tbody>";

                        while ($row = mysqli_fetch_assoc($resultat)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['id_ordonnance']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nom_patient']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['prenom_patient']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['id_dossier']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['medicaments']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email_patient']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email_medecin']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['date_creation']) . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                        echo "</div>";
                    } else {
                        echo "<p class='mt-3'>Aucune ordonnance trouvée pour cet e-mail et cet ID dossier.</p>";
                    }
                } else {
                    echo "<p class='mt-3'>Erreur lors de l'exécution de la requête : " . mysqli_error($connexion) . "</p>";
                }

                // Fermeture de la connexion
                mysqli_close($connexion);
            }
        }
        ?>
    </div>

    <!-- Scripts Bootstrap (ne pas modifier) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-2j0R0FZ2xFeFHx89WJW81zEF9CPaVG3FupvcF8/JpMN44j1ZjmDS7fM52kcJ00/c" crossorigin="anonymous"></script>
</body>
</html>
