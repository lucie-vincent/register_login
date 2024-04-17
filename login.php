<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>

    <h1>Se connecter</h1>
    <form action="traitement.php?action=login" method="POST">

        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br>

        <label for="password">Mot de passe</label>
        <input type="password" name="pass1" id="password"><br>

        <input type="submit" name="submit" value="Se connecter">
    </form>
    
</body>
</html>