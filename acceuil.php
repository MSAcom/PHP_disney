<?php
session_start();//Démarrage session

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Récupérer l'identifiant de l'utilisateur à partir de la session
$identifiant = $_SESSION['identifiant'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Acceuil</title>
    <link rel="stylesheet" href="./acceuil.css">

</head>
<body>
    <nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="#" class="desktopMenuListItem">Home</a> <!-- a href pour redirection pages -->
            <a href="./attractions.php" class="desktopMenuListItem">Attractions</a>
            <a href="./pagefavoris.php" class="desktopMenuListItem">Favoris</a>
            <a href="deconnexion.php" class="desktopMenuListItem">Deconnexion</a>
        </div>
        <p> <span class="pastille"></span> connecté </p>

    </nav>

    <h1>BIENVENUE À DISNEYLAND, <?php echo $identifiant; ?> !</h1><!--Personnalisation de la session -->
    <img src= "./banderole_2.jpg" class="banner" /> 
    
</body>
</html>