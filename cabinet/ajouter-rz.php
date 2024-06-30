<?php
    if(isset($_POST['send'])){
        if(isset($_POST['NomMedecin']) &&
            isset($_POST['Date']) &&
            isset($_POST['heure']) &&
            isset($_POST['heure_fin']) &&
            isset($_POST['Nom_patient']) &&
            $_POST['NomMedecin'] !="" &&
            $_POST['Date'] !="" &&
            $_POST['heure'] !="" &&
            $_POST['heure_fin'] !="" &&
            $_POST['Nom_patient'] !="") {
            include_once "connect_ddb.php";
            extract($_POST);

            $sql = "INSERT INTO rdv(NomMedecin,Date,heure,heure_fin,Nom_patient) VALUES('$NomMedecin', '$Date','$heure','$heure_fin','$Nom_patient')";
            if(mysqli_query($conn, $sql)){
                header("location: showrdv.php");
            }else{
                header("location:addrdv.php?message=AddFail");
            }
        }else{
            header("location:addrdv.php?message=EmptyFields");
        }
    
    } 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  

  <link
  rel="stylesheet"
  href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
  crossorigin="anonymous"
  >

  <title>Hopital</title>
  <style>
    /* Ajoutez votre CSS personnalisé ici */
    body {
      background-color: #ecf0f1; /* Bleu clair pour le fond */
      color: #333; /* Couleur de texte principale */
    }

    .jumbotron {
      background-color: #3498db; /* Fond bleu pour le jumbotron */
      color: #fff; /* Couleur de texte blanche pour le jumbotron */
      padding: 100px 0; /* Espacement interne du jumbotron */
    }

    .jumbotron h1 {
      font-size: 3.5rem; /* Taille de police pour le titre */
      font-weight: bold; /* Police en gras pour le titre */
    }

    .centered-form {
      background: #fff; /* Fond blanc pour le formulaire */
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Ombre légère */
    }

    .centered-form input[type="text"],
    .centered-form input[type="submit"] {
      margin-bottom: 10px; /* Espacement entre les champs */
    }

    .centered-form .link {
      margin-top: 10px; /* Espacement entre le bouton et le lien */
    }

    .bg-dark {
      background-color: #3498db; /* Fond bleu foncé pour le pied de page */
      color: #fff; /* Couleur de texte blanche pour le pied de page */
    }
  </style>
</head>

<body>
  <div class="bg-dark">
    <div class="container">
      <div class="row">
        <nav class="col navbar navbar-expand-lg navbar-dark">
          <a class="navbar-brand" href="index.html">MediTeam</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div id="navbarContent" class="collapse navbar-collapse">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="index.html">Accueil</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="lessons.html">Cours</a>
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
        <h1></h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12 col-lg-4">
        <div>
          <form class="centered-form" action="" method="post">
            <h1>Ajouter Rendez-vous</h1>
            <input type="text" name="NomMedecin" placeholder="NomMedecin">
            <input type="text" name="Date" placeholder="Date">
            <input type="text" name="heure" placeholder="heure">
            <input type="text" name="heure_fin" placeholder="heure_fin">
            <input type="text" name="Nom_patient" placeholder="Nom_patient">
            <input type="submit" value="Ajouter" name="send" class="btn btn-primary"> <!-- Utilisation de classes Bootstrap pour styliser le bouton -->
            <a href="showrdv.php" class="link back">Annuler</a>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <p></p>
      </div>
    </div>
    <div class="bg-dark">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  </html>
