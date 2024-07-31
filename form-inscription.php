<?php

require 'inscription.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="inscription.php" method="POST">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" name="username">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password">
        <label for="email">Adresse e-mail:</label>
        <input type="email" name="email">
        <input type="submit" value="Envoyer">
    </form>
</body>
</html>