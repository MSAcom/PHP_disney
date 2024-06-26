<?php
//Vérifie si les données nécessaires pour l'inscription (nom, prénom, identifiant et mot de passe) ont été envoyées via la méthode POST.
if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['identifiant']) && isset($_POST['mot_de_passe'])) {

    $file_name = 'utilisateurs.csv';// Définit le nom du fichier CSV dans lequel les informations des utilisateurs seront enregistrées.

    $file = fopen($file_name, 'a');//Ouvre le fichier en mode écriture afin d'ajouter à la fin du fichier sans écraser.

    if (filesize($file_name) == 0) {//Vérifie si le fichier CSV est vide. Si c'est le cas, il ajoute une ligne d'en-tête contenant les noms des champs.
        fputcsv($file, ['Id_utilisateur', 'Nom', 'Prenom', 'Identifiant', 'Mot_de_passe', 'Admin']);
    }
    $id_utilisateur = uniqid();//on définit un id unique pour chaque nouvelle inscription
    $admin = "False"; // on initie la variable en false pour pas que tlm soit considéré comme administrateur.
    //on change manuellement en true cette variable dans le fichier utilisateurs.csv 


    $password_hash = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);//Utilise la fonction password_hash() pour hasher le mot de passe avant de l'enregistrer. Cela améliore la sécurité en stockant des mots de passe sécurisés dans le fichier CSV.

    fputcsv($file, [$id_utilisateur, $_POST['nom'], $_POST['prenom'], $_POST['identifiant'], $password_hash, $admin]);//Écrit une nouvelle ligne dans le fichier CSV avec les informations de l'utilisateur, y compris le nom, le prénom, l'identifiant et le mot de passe hashé.

    fclose($file);//Fermeture du fichier.
 

    header('Location: connexion.php');//Redirige l'utilisateur vers la page de connexion après avoir réussi l'inscription.
}
