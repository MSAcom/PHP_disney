<?php
session_start(); 
$error = ""; 

if (isset($_POST['identifiant']) && isset($_POST['mot_de_passe'])) { //isset permet de vérifier si la variable est bien remplie
    $file_name = 'utilisateurs.csv'; //nomme le fichier qui va être créer et stocker les informations de la page inscription
    $file = fopen($file_name, 'r'); // ouvre fichier en mode lecture seulement

    if ($file) {
        while (($line = fgetcsv($file)) !== false) {// parcours chaque ligne du fichier
            if ($line[3] === $_POST['identifiant']) {// verifie si identifiant correspond à celui stocké ds le csv
                if (password_verify($_POST['mot_de_passe'], $line[4])) {//verifie si mdp est le meme que celui haché ds le fichier csv (le mdp est 5e dans le fichier, donc en indice 4)
                    $_SESSION['identifiant'] = $_POST['identifiant'];
                    $_SESSION['id_utilisateur'] = $line[0];
                    $_SESSION['admin'] = $line[5];
                    fclose($file);
                    if ($_SESSION['admin']=== "True") {
                        header('Location: attractions_admin.php');
                    }
                    else {
                    header('Location: acceuil.php');} //redirection si tout est bon
                    exit();
                } else {
                    $error = "Le mot de passe est incorrect.";
                }
            } else {
                $error = "L'identifiant n'existe pas.";
            }
        }
        fclose($file);
    } else {
        $error = "Erreur lors de l'ouverture du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="./acceuil.css">
    <style>/* css dans html*/
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="#" class="desktopMenuListItem">Evenements</a>
            <a href="#" class="desktopMenuListItem">Restauration</a>
            <a href="https://www.disneylandparis.com/fr-fr/hotels-disney?ecid=SEM_IP_S_8537264857-c-99283304142-495257146032-576642349168-Broad&gclsrc=aw.ds&&mkwid=0BnHNBuC&gad_source=1&gclid=CjwKCAiAopuvBhBCEiwAm8jaMcxku_II7Q_OxRbsuI5fGmhIENXmIY6FGYoo-ivaVq16CGQRYm46ThoCaBgQAvD_BwE&pcrid=576642349168&pmt=b&pkw=reservation+hotel+disney" class="desktopMenuListItem">Hebergement</a>
            <a href="./inscription.php" class="desktopMenuListItem">Inscription</a>
        </div>
        
    </nav>
    <div class="container">
        <h2>Connexion</h2>
        <?php if ($error !== "") : ?><!--si erreur est different de vide, donc affiche un message -->
            <p class="error"><?php echo $error; ?></p><!--affiche le message d'erreur-->
        <?php endif; ?>
        <form action="" method="post"><!--formulaire-->
            <label for="identifiant">Identifiant :</label>
            <input type="text" id="identifiant" name="identifiant" required>
            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" id="mot_de_passe" name="mot_de_passe" required>

            
            <input type="submit" value="Se connecter">
        </form>
        <img src="./pic4.jpg" id="image4"> <!--image-->

    </div>
</body>

</html>