<?php
require 'db.php';

$stmt = $conn->prepare("INSERT INTO users (`username`, `password`, `email`)
VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $password, $email);

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $stmt->execute();
    header('location:compte_cree.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>
<body>
    <?php include 'header.php';?>
    <h1>S'inscrire</h1>
    <form action="form-inscription.php" method="POST">
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