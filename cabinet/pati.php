<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hôpital</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

<?php
session_start();

// Vérifiez si l'utilisateur est connecté et affichez son adresse e-mail
if (isset($_SESSION['user_login'])) {
    echo "<p>Adresse e-mail de l'utilisateur connecté : " . $_SESSION['user_login'] . "</p>";
} else {
    echo "<p>Utilisateur non connecté.</p>";
}
?>

<div class="bg-dark">
    <div class="container">
        <div class="row">
            <nav class="col navbar navbar-expand-lg navbar-dark">
                <img src="images/png-clipart-hospital-logo-clinic-health-care-physician-business-thumbnail.png" width="40" height="30" alt="Logo du site">
                <a class="navbar-brand" href="index.html">MediTeam</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav "> 
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">Accueil</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="connexion.html">Logout</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div id="carouselControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="images/doc.jfif" class="d-block w-100" alt="patient1">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Précédent</span>
                </a>
                <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Suivant</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Consultation</h5>
                    <p class="card-text">Consulter son dossier.</p>
                    <a href="ex.php" class="btn btn-primary">Consulter son dossier</a>
                </div>
            </div>
        </div>
        

        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Consultation</h5>
                    <p class="card-text">Consulter son ordonnance.</p>
                    <a href="consulterdossier.php" class="btn btn-primary">Consulter son ordonnance</a>
                </div>
            </div>
        </div>

        
       


<div class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col">
                <ul class="list-inline text-center">
                    <li class="list-inline-item"><a href="#">À propos</a></li>
                    <li class="list-inline-item">&middot;</li>
                    <li class="list-inline-item"><a href="#">Vie privée</a></li>
                    <li class="list-inline-item">&middot;</li>
                    <li class="list-inline-item"><a href="#">Conditions d'utilisation</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
