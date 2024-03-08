<!--N'EST PLUS UTILE POUR LE PROJET CAR PLUS DERREUR QUAND AJOUTE AUX FAVORIS MARQUE "DEJA AJOUTE AUX FAVORIS" -->
 

<?php
session_start();
 
// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}
 
// Récupérez l'identifiant de l'utilisateur à partir de la session
$identifiant = $_SESSION['identifiant'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./acceuil.css">
    <title>Erreur</title>
    

</head>
<body>
    <nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="./acceuil.php" class="desktopMenuListItem">Home</a>
            <a href="./attractions.php" class="desktopMenuListItem">Attractions</a>
            <a href="./pagefavoris.php" class="desktopMenuListItem">Favoris</a>
            <a href="./deconnexion.php" class="desktopMenuListItem">Deconnexion</a>
        </div>
        <p> <span class="pastille"></span> connecté </p>

    </nav>
    <br>
    <div class='erreur'>Cette attraction est déja dans vos favoris, ajoutez en une autre !</p>
    <p>
</body>
</html>