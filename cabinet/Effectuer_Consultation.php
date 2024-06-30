<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Effectuer Consultation</title>
</head>
<body>
    <h1>Effectuer Consultation</h1>
    <!-- Mettez le contenu de votre formulaire ou les détails de la consultation ici -->
    <form action="traitement_consultation.php" method="post">
        <label for="nom_patient">Nom du patient:</label>
        <input type="text" id="nom_patient" name="nom_patient">
        
        <label for="date_consultation">Date de consultation:</label>
        <input type="date" id="date_consultation" name="date_consultation">
        
        <label for="symptomes">Symptômes:</label>
        <textarea id="symptomes" name="symptomes"></textarea>
        
        <input type="submit" value="Enregistrer consultation">
    </form>
</body>
</html>
