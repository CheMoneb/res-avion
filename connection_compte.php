<?php

require 'db.php';

$query = $conn->prepare("SELECT `username`, `password`, `email` FROM `users`
        WHERE `username` = ?
        AND `password` = ?
        AND `email` = ?");
$query->bind_param('sss', $username, $password, $email);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $query->execute();
    $result = $mysqli->query($query);
    $user = $result->fetch_array(MYSQLI_ASSOC);
    if($user === false) {
        header('location:connection_compte.php');
    }
    else {
        if($username == $user['username'])
            if($username == $user['password'])
                if($username == $user['email'])
                    echo "Vous êtes connecté";
                else {
                    header('location:connection_compte.php');
                }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
</head>
<body>
    <h1>Se connecter</h1>
    <form action="connection_compte.php" method="post">
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