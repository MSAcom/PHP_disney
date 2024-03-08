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

// Vérifie si l'identifiant de l'attraction à retirer est défini dans la requête POST
if (isset($_POST['id'])) {
    // Récupérer l'identifiant de l'attraction à retirer des favoris
    $attraction_id = $_POST['id'];

    // Lire le fichier des favoris
    $file_name = 'favoris.csv';
    $favoris = file($file_name);

    // Ouvrir le fichier en mode écriture
    $file = fopen($file_name, 'w');

    // Parcourir les lignes des favoris
    foreach ($favoris as $ligne) {
        // Récupérer les données de l'attraction de la ligne
        $attraction_data = str_getcsv($ligne);

        // Vérifier si l'identifiant de l'attraction ne correspond pas à celui à retirer
        // et si l'identifiant de l'utilisateur associé à cette attraction est celui de l'utilisateur connecté
        if ($attraction_data[0] != $attraction_id || $attraction_data[4] != $id_utilisateur) {
            // Si oui, écrire la ligne dans le fichier
            fwrite($file, $ligne);
        }
    }

    // Fermer le fichier
    fclose($file);
}

// Rediriger vers la page favoris
header("Location: pagefavoris.php");
?>
