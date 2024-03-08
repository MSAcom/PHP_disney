<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['identifiant'])) {
    // Redirigez l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

// Vérifiez si l'identifiant de l'attraction à retirer a été envoyé via la méthode POST
if (isset($_POST['id'])) {
    $id_attraction_a_retirer = $_POST['id'];
    
    // Ouvrir le fichier CSV des attractions
    $file_name = 'attraction.csv';
    $file = fopen($file_name, 'r');
    
    // Créer un fichier temporaire pour stocker les attractions sans l'attraction à retirer
    $temp_file_name = 'attraction_temp.csv';
    $temp_file = fopen($temp_file_name, 'w');

    // Parcourir chaque ligne du fichier CSV des attractions
    while (($line = fgetcsv($file)) !== false) {
        // Si l'identifiant de l'attraction ne correspond pas à celui à retirer, écrire la ligne dans le fichier temporaire
        if ($line[0] != $id_attraction_a_retirer) {
            fputcsv($temp_file, $line);
        }
    }
    
    // Fermer les fichiers
    fclose($file);
    fclose($temp_file);
    
    // Remplacer le fichier d'attractions par le fichier temporaire 
    rename($temp_file_name, $file_name);
    
    // Rediriger vers la page attractions
    header("Location: pageretirer.php");
    exit();
} else {
    // Rediriger vers la page retirer des attractions 
    header("Location: pageretirer.php");
    exit();
}
?>