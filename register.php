<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>

    <h1>S'inscrire</h1>
    <form action="traitement.php?action=register" method="POST">
        <label for="nickname">Pseudo</label>
        <input type="text" name="nickname" id="nickname"><br>

        <label for="email">Email</label>
        <input type="text" name="email" id="email"><br>

        <label for="pass1">Mot de passe</label>
        <input type="password" name="pass1" id="pass1"><br>

        <label for="pass2">Confirmation du mot de passe</label>
        <input type="password" name="pass2" id="pass2"><br>

        <input type="submit" name="submit" value="S'inscrire">
    </form>
    
</body>
</html>