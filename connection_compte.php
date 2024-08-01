<?php
require 'db.php';



if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $query = $conn->prepare("SELECT * FROM `users`
        WHERE `username` = ?
        AND `password` = ?
        AND `email` = ?");
    $query->bind_param('sss', $username, $password, $email);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_all(MYSQLI_ASSOC);
    if(!$user) {
        header('location:connection_compte.php');
    } else {
        foreach($user as $u) {
            $_SESSION['user_id'] = $u['id'];
            $_SESSION['username'] = $u['username'];
        }
        header('location:Booking.php');
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
    <?php include 'header.php';?>
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