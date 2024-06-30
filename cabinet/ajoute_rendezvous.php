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

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $num_rv = mysqli_real_escape_string($connexion, $_POST['num_rv']);
    $email_medecin = mysqli_real_escape_string($connexion, $_POST['email_medecin']);
    $date = mysqli_real_escape_string($connexion, $_POST['date']);
    $nom_patient = mysqli_real_escape_string($connexion, $_POST['nom_patient']);
    $prenom_patient = mysqli_real_escape_string($connexion, $_POST['prenom_patient']);
    $email_patient = mysqli_real_escape_string($connexion, $_POST['email_patient']);

    // Validation des champs (assurez-vous qu'ils ne sont pas vides)
    if (empty($num_rv) || empty($email_medecin) || empty($date) || empty($nom_patient) || empty($prenom_patient) || empty($email_patient)) {
        echo "Veuillez remplir tous les champs du formulaire.";
    } else {
        // Préparation de la requête SQL pour l'insertion
        $requete_insertion = "INSERT INTO rendezvous (num_rv, email_medecin, date, nom_patient, prenom_patient, email_patient) 
                              VALUES ('$num_rv', '$email_medecin', '$date', '$nom_patient', '$prenom_patient', '$email_patient')";

        // Exécution de la requête d'insertion
        if (mysqli_query($connexion, $requete_insertion)) {
            echo "<h1>Rendez-vous ajouté avec succès !</h1>";
        } else {
            echo "Erreur lors de l'ajout du rendez-vous : " . mysqli_error($connexion);
        }
    }
}

// Fermeture de la connexion à la base de données
mysqli_close($connexion);
?>

<!-- Scripts Bootstrap (ne pas modifier) -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-2j0R0FZ2xFeFHx89WJW81zEF9CPaVG3FupvcF8/JpMN44j1ZjmDS7fM52kcJ00/c" crossorigin="anonymous"></script>
</body>
</html>
