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
    <link rel="stylesheet" href="./card.css">
</head>
<body>
    <nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="./attractions_admin.php" class="desktopMenuListItem">Attractions</a>     
            <a href="./pageajouteratt.php" class="desktopMenuListItem">Ajouter des Attractions</a>
            <a href="./retirerattractions.php" class="desktopMenuListItem">Supprimer des Attractions</a>
            <a href="deconnexion.php" class="desktopMenuListItem">Deconnexion</a>
        </div>
        <p> <span class="pastille"></span> admin </p>
    </nav>
    <h1> LES ATTRACTIONS DE DISNEYLAND : </h1>

    <div class="page">
        <?php
        // Ouvrir le fichier des attraction en lecture
        $attraction_file = fopen("attraction.csv", "r");

        // Lire les données des attraction
        $attraction_data = [];
    
        fclose($attraction_file);

        // Ouvrir le fichier des attractions en lecture
        $attraction_file = fopen("attraction.csv", "r");
        $en_tete = fgetcsv($attraction_file); // Ignorer l'en-tête

        // Recherchez les index des colonnes spécifiques
        $col_id = array_search('id', $en_tete);
        $col_nom = array_search('nom', $en_tete);
        $col_image = array_search('image', $en_tete);
        $col_description = array_search('description', $en_tete);


        
        // Afficher chaque attraction
        while (($attraction_data = fgetcsv($attraction_file)) !== FALSE) {
            $attraction_id = $attraction_data[$col_id];

            // Vérifier si l'attraction est déjà dans les attraction de l'utilisateur
            

            // Afficher le bouton approprié en fonction de la condition ci-dessus
            ?>
            <div class="tableau">
                <div class="card">
                    <div class='texte'><?php echo $attraction_data[$col_nom]; ?></div>
                    <div class='image'><img class='attraction' src='<?php echo $attraction_data[$col_image]; ?>'></div>
                    <div class='description'><?php echo $attraction_data[$col_description]; ?></div>
                    <div>
                    <form action="retirerattractions.php" method="post"> <!--ce form renvoie vers retirerattraction.php afin de pouvoir à présent retirer des attraction-->
                        <input type="hidden" name="id" value="<?php echo $attraction_data[$col_id]; ?>"><!-- <input type="hidden":stockent les informations de l'attraction dans des champs cachés, afin qu'elles soient envoyées avec le formulaire-->
                        <input type="hidden" name="nom" value="<?php echo $attraction_data[$col_nom]; ?>"><!-- on stocke ici toutes les informations à ajouter dans les attraction-->
                        <input type="hidden" name="image" value="<?php echo $attraction_data[$col_image]; ?>">
                        <input type="hidden" name="description" value="<?php echo $attraction_data[$col_description]; ?>">
                        
                        <button type="submit">Supprimer</button>
                    </form>
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
