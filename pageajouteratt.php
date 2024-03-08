<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérez l'identifiant de l'utilisateur à partir de la session
$id_utilisateur = $_SESSION['id_utilisateur'];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="acceuil.css">
    <title>Ajout des Attractions</title>
</head>
<body>
<nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="./attractions_admin.php" class="desktopMenuListItem">Attraction</a>
            <a href="./pageajouteratt.php" class="desktopMenuListItem">Ajouter des Attractions</a>
            <a href="./retirerattractions.php" class="desktopMenuListItem">Supprimer des Attractions</a>
            <a href="deconnexion.php" class="desktopMenuListItem">Deconnexion</a>
        </div>
        <p> <span class="pastille"></span> admin </p>

    </nav>
    <div class="container">
    <h2>Ajouter une attraction</h2>
    <form action="ajouteratt.php" method="post" class="ajout-attraction-form">

    
        <label for="nom">Nom de l'attraction :</label>
        <input type="text" id="nom" name="nom" required>
        
        <label for="image">URL de l'image :</label>
        <input type="text" id="image" name="image" required>
        
        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        
        <input type="submit" value="Ajouter l'attraction">
    </form>
</div>
</body>
</html>