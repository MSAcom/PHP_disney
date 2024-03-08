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
    <title>Favoris</title>
    <link rel="stylesheet" href="./card.css">
    <link rel="stylesheet" href="./acceuil.css">
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
    <h1> Les attractions dans vos favoris </h1>
    <div class="page">

    <?php
    // Ouvrir le fichier des favoris en lecture
    $file = fopen("favoris.csv", "r");
    
    // Lire la première ligne pour obtenir les noms des colonnes
    $en_tete = fgetcsv($file, 0, ",");
    
    // Recherchez les index des colonnes spécifiques
    $col_id = array_search('identifiant', $en_tete);
    $col_nom = array_search('nom', $en_tete);
    $col_image = array_search('image', $en_tete);
    $col_description = array_search('description', $en_tete);
    $col_id_utilisateur = array_search('id_utilisateur', $en_tete);

    // Afficher uniquement les favoris de l'utilisateur actuel
    while (($data = fgetcsv($file, 10000, ",")) !== FALSE) {
        if ($data[$col_id_utilisateur] == $id_utilisateur) {
            ?>
            <div class="tableau">
                <div class="card"> <!-- on crée des cards pour chaque favoris -->
                    <div class='texte'><?php echo $data[$col_nom]; ?>
                    <style>
                            .texte {
                                height : 30px ;
                            }
                    </style>
                    </div>
                    <div class='image'><img class='attraction' src='<?php echo $data[$col_image]; ?>'>
                    <style>
                            .attraction {
                                height : 145px ;
                            }
                    </style>
                     </div>
                    <div class='description'><?php echo $data[$col_description]; ?>
                    <style>
                            .description {
                                height : 80px ;
                            }
                    </style>
                    </div>
                    <!--<div class='texte'> Cette attraction à déjà été mise en favoris par personne(s)</div> Nous voulions mettre un compteur dans les favoris-->
                    <form action="retirerfavoris.php" method="post"> <!--ce form caché renvoie vers retirerfavoris.php afin de pouvoir à présent retirer des favoris-->
                        <input type="hidden" name="id" value="<?php echo $data[$col_id]; ?>"><!-- <input type="hidden":stockent les informations de l'attraction dans des champs cachés, afin qu'elles soient envoyées avec le formulaire-->
                        <input type="hidden" name="nom" value="<?php echo $data[$col_nom]; ?>"><!-- on stocke ici toutes les informations à ajouter dans les favoris-->
                        <input type="hidden" name="image" value="<?php echo $data[$col_image]; ?>">
                        <input type="hidden" name="description" value="<?php echo $data[$col_description]; ?>">
                        <input type="hidden" name="id_utilisateur" value="<?php echo $data[$col_id_utilisateur]; ?>">
                        <button type="submit">Retirer des favoris</button>
                    </form>

                </div>
            </div>
            <?php
        }
    }
    fclose($file);
    ?>
    </div>
</body>
</html>
