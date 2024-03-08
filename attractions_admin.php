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
    <title>Page Attractions</title>
    <link rel="stylesheet" href="./acceuil.css">
    <link rel="stylesheet" href="card.css">
</head>
<body>
    <nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="" class="desktopMenuListItem">Attractions</a>     
            <a href="./pageajouteratt.php" class="desktopMenuListItem">Ajouter des Attractions</a>
            <a href="./retirerattractions.php" class="desktopMenuListItem">Supprimer des Attractions</a>
            <a href="deconnexion.php" class="desktopMenuListItem">Deconnexion</a>
        </div>
        <p> <span class="pastille"></span> admin </p>
    </nav>
    <h1> LES ATTRACTIONS DE DISNEYLAND : </h1>

    <div class="page">
        <?php
    
        
        $attraction_file = fopen("attraction.csv", "r");// Ouvrir le fichier des attractions en lecture
        $en_tete = fgetcsv($attraction_file); // Ignorer l'en-tête

        // Recherchez les index des colonnes spécifiques
        $col_id = array_search('id', $en_tete);
        $col_nom = array_search('nom', $en_tete);
        $col_image = array_search('image', $en_tete);
        $col_description = array_search('description', $en_tete);

        // Afficher chaque attraction
        while (($attraction_data = fgetcsv($attraction_file)) !== FALSE) {
            $attraction_id = $attraction_data[$col_id];

            ?>
            <div class="tableau">
                <div class="card"> <!--pour chaque carte-->
                    <div class='texte'><?php echo $attraction_data[$col_nom]; ?> <!--on affiche titre de l'attraction-->
                    <style>
                            .texte {
                                height : 30px ;
                            }
                    </style>
                    </div>
                    <div class='image'><img class='attraction' src='<?php echo $attraction_data[$col_image]; ?>'> <!--on affiche image de l'attraction-->
                    <br>
                    <style>
                            .attraction {
                                height : 145px ;
                                padding-bottom : 20px ; 
                                
                            }
                    </style></div>
                    <div class='description'><?php echo $attraction_data[$col_description]; ?> <!--on affiche description de l'attraction-->
                    <style>
                            .description {
                                height : 80px ;
                            }
                    </style>
                    </div>
                </div>
            </div>
            <?php
        }

        fclose($attraction_file);
        ?>
    </div>
</body>
</html>
