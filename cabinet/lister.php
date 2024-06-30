<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
       body {
            color: #000;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-image: url('olp.jfif'); /* Ajoutez le chemin de votre image de fond */
            background-size: cover; /* Pour couvrir tout l'arrière-plan */
            background-position: center; /* Pour centrer l'image */
            background-repeat: no-repeat; /* Pour éviter la répétition de l'image */
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

    <div class="container mt-4">
        <h1 class="mb-4">Liste des Utilisateurs :</h1>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Login</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Connexion à la base de données
                $serveur = "localhost";
                $utilisateur = "root";
                $motDePasse = "";
                $baseDeDonnees = "connect";

                $connexion = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

                // Vérification de la connexion
                if (!$connexion) {
                    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
                }

                // Requête SQL pour sélectionner tous les utilisateurs
                $requete = "SELECT * FROM users";
                $resultat = mysqli_query($connexion, $requete);

                // Vérification si des utilisateurs sont trouvés
                if (mysqli_num_rows($resultat) > 0) {
                    // Affichage des utilisateurs dans une table
                    while ($utilisateur = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        echo "<td>" . $utilisateur['id'] . "</td>";
                        echo "<td>" . $utilisateur['login'] . "</td>";
                        echo "<td>" . $utilisateur['type'] . "</td>";
                        echo "<td>";
                        echo "<a href='modifiercompte.php?id=" . $utilisateur['id'] . "' class='btn btn-primary btn-sm mr-2'>Modifier</a>";
                        echo "<a href='supprimerutilisateur.php?id=" . $utilisateur['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\");'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Aucun utilisateur trouvé.</td></tr>";
                }

                // Fermer la connexion à la base de données
                mysqli_close($connexion);
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts Bootstrap (ne pas modifier) -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-2j0R0FZ2xFeFHx89WJW81zEF9CPaVG3FupvcF8/JpMN44j1ZjmDS7fM52kcJ00/c" crossorigin="anonymous"></script>
</body>
</html>
