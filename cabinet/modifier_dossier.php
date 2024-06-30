<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Dossier Médical</title>
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
        <?php
        $serveur = "localhost";
        $utilisateur = "root";
        $motDePasse = "";
        $baseDeDonnees = "connect";
        $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

        if (!$connexion) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }

        $id = $_GET['id'];
        $requete_info = "SELECT * FROM dossier WHERE NumDossier = ?";
        $stmt = mysqli_prepare($connexion, $requete_info);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $resultat_info = mysqli_stmt_get_result($stmt);

        if ($resultat_info && mysqli_num_rows($resultat_info) > 0) {
            $row_info = mysqli_fetch_assoc($resultat_info);
        ?>
            <form method="post" action="traiter_modification.php">
                <input type="hidden" name="NumDossier" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="nom_patient">Nom du patient :</label>
                    <input type="text" class="form-control" id="nom_patient" name="nom_patient" value="<?php echo $row_info['nom_patient']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom_patient">Prénom du patient :</label>
                    <input type="text" class="form-control" id="prenom_patient" name="prenom_patient" value="<?php echo $row_info['prenom_patient']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="date">Date :</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $row_info['date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="poids">Poids :</label>
                    <input type="text" class="form-control" id="poids" name="poids" value="<?php echo $row_info['poids']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="temperature">Température :</label>
                    <input type="text" class="form-control" id="temperature" name="temperature" value="<?php echo $row_info['Temperature']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="remarque">Remarque :</label>
                    <input type="text" class="form-control" id="remarque" name="remarque" value="<?php echo $row_info['Remarque']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="bilan">Bilan :</label>
                    <input type="text" class="form-control" id="bilan" name="bilan" value="<?php echo $row_info['Bilan']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="maladie">Maladie :</label>
                    <input type="text" class="form-control" id="maladie" name="maladie" value="<?php echo $row_info['Maladie']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="symptomes">Symptômes :</label>
                    <input type="text" class="form-control" id="symptomes" name="symptomes" value="<?php echo $row_info['Symptomes']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="heure">Heure :</label>
                    <input type="time" class="form-control" id="heure" name="heure" value="<?php echo $row_info['heure']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mail_patient">Mail du patient :</label>
                    <input type="email" class="form-control" id="mail_patient" name="mail_patient" value="<?php echo $row_info['mail_patient']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mail_medecin">Mail du médecin :</label>
                    <input type="email" class="form-control" id="mail_medecin" name="mail_medecin" value="<?php echo $row_info['mail_medecin']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        <?php
        } else {
            echo "Aucun dossier médical trouvé.";
        }

        mysqli_close($connexion);
        ?>
    </div>

    <!-- Scripts Bootstrap (ne pas modifier) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-2j0R0FZ2xFeFHx89WJW81zEF9CPaVG3FupvcF8/JpMN44j1ZjmDS7fM52kcJ00/c" crossorigin="anonymous"></script>
</body>
</html>
