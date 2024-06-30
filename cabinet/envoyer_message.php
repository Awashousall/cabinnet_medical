<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Hôpital</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Contactez-nous</h1>
    <p class="lead">N'hésitez pas à nous contacter pour toute question ou demande.</p>
    <div class="row">
        <div class="col-md-6">
            <h3>Coordonnées</h3>
            <p><strong>Hôpital [SUNU SANTE]</strong><br>
            [PIKINE TALLY BOU BESS]<br>
            [DAKAR , 2905]<br>
            <strong>Téléphone :</strong> [778789045]<br>
            <strong>Email :</strong> <a href="mailto:awasall@hopital.com">awasall@hopital.com</a></p>
        </div>
        <div class="col-md-6">
            <h3>Formulaire de Contact</h3>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nom = htmlspecialchars($_POST['nom']);
                $email = htmlspecialchars($_POST['email']);
                $message = htmlspecialchars($_POST['message']);
                $to = "awasall@hopital.com";
                $subject = "Nouveau message de contact";
                $body = "Nom: $nom\nEmail: $email\nMessage:\n$message";
                $headers = "From: $email";

                if (mail($to, $subject, $body, $headers)) {
                    echo '<div class="alert alert-success" role="alert">Votre message a été envoyé avec succès.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'envoi du message. Veuillez réessayer plus tard.</div>';
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="nom">Nom complet :</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message :</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
