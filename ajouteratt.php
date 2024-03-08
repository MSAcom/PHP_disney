<?php 
$file_name = 'attraction.csv'; // stock le fichier ds une variable 
$file = fopen($file_name, 'a'); // ouvre le fichier
if (filesize($file_name) == 0) { // si fichier vide, mettre à la première ligne le nom des colonnes
    fputcsv($file, ['identifiant', 'nom', 'image', 'description']);
}
$identifiant_attr = uniqid();//on définit un id unique pour chaque nouvelle attraction


//verifie si l'attraction existe déjà
$attraction_existe = false;// initialise la variable à faux
if (($handle = fopen($file_name, "r")) !== false) { //ouvre en lecture le fichier attraction.csv
    while (($row = fgetcsv($handle, 1000, ",")) !== false) { // parcours le fichier ligne par ligne
        if ($row[1] == $_POST['nom'] && $row[2] == $_POST['image'] && $row[3] == $_POST['description']) { //si tous les champs remplis dans le form correspondent à une ligne déjà présente dans le csv 
            $attraction_existe = true; // on passe la variable à vrai
            break;
        }
    }
    fclose($handle);
}

// Si l'attraction n'existe pas, on l'ajoute
if (!$attraction_existe) {
    fputcsv($file, [$identifiant_attr, $_POST['nom'], $_POST['image'], $_POST['description']]); //remplir les champs suivants 
}

fclose($file); 
header("Location: attractions_admin.php"); //redirection 
?>