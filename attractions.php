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
            <a href="./acceuil.php" class="desktopMenuListItem">Home</a>
            <a href="#" class="desktopMenuListItem">Attractions</a>
            <a href="./pagefavoris.php" class="desktopMenuListItem">Favoris</a>
            <a href="deconnexion.php" class="desktopMenuListItem">Deconnexion</a>
        </div>
        <p> <span class="pastille"></span> connecté </p>
    </nav>
    <h1> LES ATTRACTIONS DE DISNEYLAND : </h1>

    <div class="page">
        <?php
        // Ouvrir le fichier des favoris en lecture
        $favoris_file = fopen("favoris.csv", "r");

        // Lire les données des favoris
        $favoris_data = [];
        while (($favoris_row = fgetcsv($favoris_file)) !== FALSE) {
            $favoris_data[$favoris_row[0]][] = $favoris_row[4]; // Stocker les identifiants utilisateur par identifiant d'attraction
        }
        fclose($favoris_file);

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

            // Vérifier si l'attraction est déjà dans les favoris de l'utilisateur
            $already_in_favorites = in_array($id_utilisateur, $favoris_data[$attraction_id] ?? []);

            ?>

            <div class="tableau">
                <div class="card">
                    <div class='texte'><?php echo $attraction_data[$col_nom]; ?>
                    <style> /* css */
                            .texte {
                                height : 30px ;
                            }
                    </style>
                    </div>
                    <div class='image'><img class='attraction' src='<?php echo $attraction_data[$col_image]; ?>'>
                    <br>
                    <style>
                            .attraction {
                                height : 145px ;
                            }
                    </style></div>
                    <div class='description'><?php echo $attraction_data[$col_description]; ?>
                    <style>
                            .description {
                                height : 80px ;
                            }
                    </style>
                    </div>
                    <?php if ($already_in_favorites) : ?>
                        <div class='message_fav'>Déjà dans les favoris
                        <style>
                            .message_fav {
                                font-weight: bold; 
                                color : green ;
                                border : solid 2px green ;
                            }
                         </style>
                        </div>
                    <?php else : ?> 
                        <form action="favoris.php" method="post"> <!--formulaire caché afin de récupérer les infos de l'attraction sur laquelle on clique-->
                            <input type="hidden" name="id" value="<?php echo $attraction_data[$col_id]; ?>">
                            <input type="hidden" name="nom" value="<?php echo $attraction_data[$col_nom]; ?>">
                            <input type="hidden" name="image" value="<?php echo $attraction_data[$col_image]; ?>">
                            <input type="hidden" name="description" value="<?php echo $attraction_data[$col_description]; ?>">
                            <button type="submit">Ajouter aux favoris</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php
        }

        fclose($attraction_file);
        ?>
    </div>
</body>
</html>
