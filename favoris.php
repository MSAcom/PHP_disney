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

    $utilisateur_file = fopen('utilisateur.csv', 'r');



    $file_name = 'favoris.csv';
    $attraction_id = $_POST['id']; //on récupère les informations envoyées par le formulaire caché de la page pagefavoris.php
    $attraction_nom = $_POST['nom'];
    $attraction_image = $_POST['image'];
    $attraction_description = $_POST['description'];

    $id_utilisateur = $_SESSION["id_utilisateur"];

    $file = fopen($file_name, 'a+');
    if (filesize($file_name) == 0){ //s'il n'y a rien dans le fichier, on rajoute le nom des colonnes tout en haut
        fputcsv($file, ['identifiant', 'nom', 'image', 'description', 'id_utilisateur']);
    }
    else{
        // Vérifier si le fichier des favoris existe
        if (file_exists($file_name)) {
            // Lire le contenu du fichier CSV des favoris
            $favoris = file($file_name, FILE_IGNORE_NEW_LINES);

            // Parcourir les lignes du fichier des favoris pour vérifier si l'attraction existe déjà
            $attraction_existante = false;
            foreach ($favoris as $ligne) {
                $attraction_data = str_getcsv($ligne);
                // Si l'identifiant de l'attraction existe déjà dans les favoris, définir $attraction_existante sur true
                if ($attraction_data[4] == $id_utilisateur) {

                    if ($attraction_data[0] == $attraction_id) {
                        $attraction_existante = true;
                        break;
                    }
                }
            }

            // Si l'attraction n'existe pas déjà, l'ajouter aux favoris
            if (!$attraction_existante) {
                $file = fopen($file_name, 'a');
                if (filesize($file_name) == 0) {
                    fputcsv($file, ['identifiant', 'nom', 'image', 'description', 'id_utilisateur']);
                }
                fputcsv($file, [$attraction_id, $attraction_nom, $attraction_image, $attraction_description, $id_utilisateur]);
                fclose($file);
                header("Location: attractions.php");
            } else {
                // Afficher un message si l'attraction existe déjà dans les favoris
                header("Location: erreur.php");
            }
        } else {
            // Créer le fichier des favoris s'il n'existe pas et y ajouter l'attraction
            $file = fopen($file_name, 'a');
            fputcsv($file, ['identifiant', 'nom', 'image', 'description', 'id_utilisateur']);
            fputcsv($file, [$attraction_id, $attraction_nom, $attraction_image, $attraction_description, $id_utilisateur]);
            fclose($file); //on ferme le fichier
            header("Location: pagefavoris.php"); // on renvoie vers la page des favoris
        }
    }
