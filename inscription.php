<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <link rel="stylesheet" href="./acceuil.css">

</head>

<body>
    <nav class="navbar">
        <img src="./logoo.png" height="50" alt='logo' class='logo'/>
        <div class='desktopMenu'>
            <a href="#" class="desktopMenuListItem">Evenements</a>
            <a href="#" class="desktopMenuListItem">Restauration</a>
            <a href="#" class="desktopMenuListItem">Hebergement</a>
            <a href="./connexion.php" class="desktopMenuListItem">Connexion</a>
        </div>
        
    </nav>
    <div class="container">
        <h2>Inscription</h2>
        
        <form action="traitement_inscription.php" method="post" class="inscription-form">
            <div class="form-group">
                <label for="nom">Nom (obligatoire) :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom (obligatoire):</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="identifiant">Identifiant (obligatoire):</label>
                <input type="text" id="identifiant" name="identifiant" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe (en 6 chiffres seulement):</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" pattern="\d{6}" maxlength="6" required>
            </div>
            <input type="submit" value="S'inscrire">
            <img src="./pic1.png" id="image"/>
        </form>
    </div>
</body>