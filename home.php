<!-- dans le projet forum : layout fait la mise en page -->
<!-- adapter la navbar du projet :  en fonction du statut de l'utilisateur = connecté ou non connecté-->
<!-- Avec la superglobale $_SESSION on va pouvoir vérifier le statut de l'utilisateur -->
<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // si l'utilisateur est connecté
        if(isset($_SESSION["user"])) { ?>
            <a href="traitement.php?action=logout">Se déconnecter</a>
            <a href="traitement.php?action=profile">Mon profil</a>
<?php } else {?>
            <a href="traitement.php?action=login">Se connecter</a>
            <a href="traitement.php?action=register">S'inscrire</a>
<?php } ?>
    <h1>ACCUEIL</h1>
    <?php
        if(isset($_SESSION["user"])) {
            echo "<p>Bienvenue ".$_SESSION["user"]["nickname"]."</p>";
        }
    ?>
</body>
</html>